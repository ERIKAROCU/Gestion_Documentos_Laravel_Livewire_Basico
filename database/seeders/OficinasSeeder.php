<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OficinasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Oficina::create(['nombre_oficina' => 'Oficina Central']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Gerencia de Planeamiento y Desarrollo Institucional']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Subgerencia de Planeamiento Estratégico y Modernización de la Gestión Pública']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Subgerencia de Programación de Inversión y Cooperación Técnica Nacional e Internacional']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Subgerencia de Estudios Definitivos de Proyectos de Inversión Pública']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Subgerencia de Planeamiento, Control Urbano, Rural y Catastro']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Gerencia de Infraestructura']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Subgerencia de Obras Públicas y Mantenimiento']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Subgerencia de Catastro, Control Urbano y Rural']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Gerencia de Desarrollo Económico y Medio Ambiente']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Subgerencia de Comercialización, Mercados y Actividades Económicas']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Subgerencia del Medio Ambiente, Salud Pública, Ornato de la Ciudad y OMSABA']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Subgerencia de Promoción Empresarial y Gestión de Proyectos Productivos']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Gerencia de Desarrollo Social y Servicios Públicos']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Subgerencia de Promoción Social y Participación Ciudadana']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Subgerencia de Cultura, Educación, Turismo y Deporte']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Subgerencia de Seguridad Ciudadana']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Subgerencia de Protección a los Grupos Vulnerables']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Gerencia de Administración']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Subgerencia de Recursos Humanos']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Subgerencia de Logística y Control Patrimonial']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Subgerencia de Contabilidad, Integración y Finanzas']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Subgerencia de Tesorería']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Oficina de Asesoría Jurídica']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Oficina de Supervisión y Liquidación de Proyectos de Inversión Pública']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Oficina de Administración Tributaria y Recaudación']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Oficina de Tecnología e Informática']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Oficina de Registro Civil']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Oficina de OMAPED']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Oficina de Defensa Civil']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Oficina de Ejecución Coactiva']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Oficina de Relaciones Públicas']);
        \App\Models\Oficina::create(['nombre_oficina' => 'Oficina de Mesa de Partes Virtual']);

    }
}
