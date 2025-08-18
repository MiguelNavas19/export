<?php

namespace App\Imports;

use App\Models\Color;
use App\Models\Estatus;
use App\Models\Exportacion;
use App\Models\Medida;
use App\Models\Naviera;
use App\Models\Puertos;
use App\Models\Tipo;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Str;

class ExportacionImport implements ToCollection
{
    public int $created = 0;
    public int $errors = 0;
    public array $results = [];
    public bool $previewMode = true; // Nuevo: modo de previsualización

    public function __construct(bool $previewMode = true)
    {
        $this->previewMode = $previewMode;
    }

    public function collection(Collection $rows)
    {
        $rows->each(function ($row, $index) {
            if ($index === 0) return;

            $result = [
                'row' => $index + 1,
                'data' => null,
                'error' => false,
                'message' => '',
                'exists' => false
            ];

            if (!$this->hasRequiredFields($row)) {
                $this->errors++;
                $result['error'] = true;
                $result['message'] = 'Faltan campos requeridos';
                $this->results[] = $result;
                return;
            }

            $expediente = strtoupper(Str::squish($row[1] ?? null));
            $bl = strtoupper(Str::squish($row[5]));

            if ($this->recordExists($expediente, $bl)) {
                $this->errors++;
                $result['error'] = true;
                $result['exists'] = true;
                $result['message'] = 'Registro ya existe';
                $this->results[] = $result;
                return;
            }

            try {
                $preparedData = $this->prepareData($row);
                $result['data'] = $preparedData;

                // Solo crear registros si no estamos en modo preview
                if (!$this->previewMode) {
                    Exportacion::create($preparedData);
                }

                $this->created++;
            } catch (\Exception $e) {
                $this->errors++;
                $result['error'] = true;
                $result['message'] = 'Error: ' . $e->getMessage();
            }

            $this->results[] = $result;
        });
    }

    protected function hasRequiredFields($row): bool
    {
        return isset($row[2], $row[5], $row[0]) && $row[0] !== '' && $row[2] !== '' && $row[5] !== '';
    }

    protected function recordExists(?string $expediente, string $bl): bool
    {
        $query = Exportacion::where('bl', $bl);

        if (!empty($expediente)) {
            $query->orWhere('expediente', $expediente);
        }

        return $query->exists();
    }

    protected function prepareData($row): array
    {

        return [
            'cliente'     => strtoupper(Str::squish($row[0])),
            'expediente'   => strtoupper(Str::squish($row[1])) ?? null,
            'consignatario' => strtoupper(Str::squish($row[2])),
            'renuncia'    => strtoupper(Str::squish($row[3])) ?? null,
            'poder'  => $this->autorizado($row[4]),
            'bl'          => strtoupper(Str::squish($row[5])),
            'contenedor'  => strtoupper(Str::squish($row[6])) ?? null,
            'cantidad_equipos'  => strtoupper(Str::squish($row[7])) ?? null,
            'tipo'        => $this->tiponame(strtoupper(Str::squish($row[8])), 1),
            'descripcion'  => strtoupper(Str::squish($row[9])) ?? null,
            'peso'  => strtoupper(Str::squish($row[10])) ?? null,
            'eta'         => $this->parseDate($row[11] ?? null),
            'motonave'    => strtoupper(Str::squish($row[12])) ?? null,
            'fecha_arribo'         => $this->parseDate($row[13] ?? null),
            'linea'       => $this->tiponame(strtoupper(Str::squish($row[14])), 2),
            'id_puerto'       => $this->tiponame(strtoupper(Str::squish($row[15])), 3),
            'obs'         => strtoupper(Str::squish($row[16])) ?? null,
            'envio'       => $this->tiponame(strtoupper(Str::squish($row[17])), 4),
            'estatus'       => $this->tiponame(strtoupper(Str::squish($row[18])), 5),
            'autorizado' => $this->autorizado($row[19]),
            'fecha_pago'         => $this->parseDate($row[20] ?? null),
            'fecha_veconinter'         => $this->parseDate($row[21] ?? null),
            'fecha_registro'         => $this->parseDate($row[22] ?? null),
            'dua'         => strtoupper(Str::squish($row[23])) ?? null,
            'fecha_impuesto'         => $this->parseDate($row[24] ?? null),
            'funcionario'         => strtoupper(Str::squish($row[25])) ?? null,
            'color'       => $this->tiponame(strtoupper(Str::squish($row[26])), 6),
            'fecha_presentacion'         => $this->parseDate($row[27] ?? null),
            'fecha_reconocimiento'         => $this->parseDate($row[28] ?? null),
            'fecha_validacion'         => $this->parseDate($row[29] ?? null),
            'fecha_despacho'         => $this->parseDate($row[30] ?? null),
            'fecha_devolucion'         => $this->parseDate($row[31] ?? null),
            'factura'         => strtoupper(Str::squish($row[32])) ?? null,
            'fecha_factura'         => $this->parseDate($row[33] ?? null),
            'dias_libres'         => $this->parseDate($row[34] ?? null),
            'liberacion'  => $this->parseLiberation($row[35] ?? null),
            'fecha_entrega'         => $this->parseDate($row[36] ?? null),

        ];
    }

    protected function parseDate($value): ?string
    {
        if (blank($value)) {
            return null;
        }

        try {
            if (is_numeric($value)) {
                return Carbon::instance(Date::excelToDateTimeObject($value))
                    ->format('Y-m-d');
            }

            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }

    protected function parseLiberation($value): bool
    {
        return strcasecmp(trim($value ?? ''), 'SI') === 0;
    }

    protected function autorizado($value): int
    {
        return strcasecmp(trim($value ?? ''), 'SI') === 0 ? 2 : 1;
    }


    private function tiponame($tipo, $nro)
    {

        if ($nro == 1) {

            return Medida::where('status', true)->where('nombre', $tipo)->value('nombre') ?? null;
        }

        if ($nro == 2) {

            return Naviera::where('status', true)->where('nombre', $tipo)->value('id') ?? null;
        }

        if ($nro == 3) {

            return Puertos::where('status', true)->where('nombre', $tipo)->value('id') ?? null;
        }


        if ($nro == 4) {

            return Tipo::where('nombre', $tipo)->value('id') ?? null;
        }

        if ($nro == 5) {

            return Estatus::where('nombre', $tipo)->value('id') ?? null;
        }

        if ($nro == 6) {

            return Color::where('status', true)->where('nombre', $tipo)->value('id') ?? 0;
        }
    }
}
