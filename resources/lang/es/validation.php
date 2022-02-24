<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Validación del idioma
	|--------------------------------------------------------------------------
	|
        | Las siguientes líneas de idioma contienen los mensajes de error predeterminados utilizados por
        | La clase validadora. Algunas de estas reglas tienen múltiples versiones tales
        | como las reglas de tamaño. Siéntase libre de modificar cada uno de estos mensajes aquí.
	|
	*/


	'accepted'              => 'El campo :attribute debe ser aceptado.',
	'active_url'            => 'El campo :attribute no es una URL válida.',
	'after'                 => 'El campo :attribute debe ser una fecha después de :date.',
	'after_or_equal'        => 'El campo :attribute debe ser una fecha después o igual a :date.',
	'alpha'                 => 'El campo :attribute sólo puede contener letras.',
	'alpha_dash'            => 'El campo :attribute sólo puede contener letras, números y guiones.',
	'alpha_num'             => 'El campo :attribute sólo puede contener letras y números.',
	'array'                 => 'El campo :attribute debe ser un arreglo.',
	'before'                => 'El campo :attribute debe ser una fecha antes de :date.',
	'before_or_equal'       => 'El campo :attribute debe ser una fecha antes o igual a :date.',
	'between'               => [
		'numeric' => 'El campo :attribute debe estar entre :min - :max.',
		'file'    => 'El campo :attribute debe estar entre :min - :max kilobytes.',
		'string'  => 'El campo :attribute debe estar entre :min - :max caracteres.',
		'array'   => 'El campo :attribute debe tener entre :min y :max elementos.',
	],
	'boolean'               => 'El campo :attribute debe ser verdadero o falso.',
	'confirmed'             => 'El campo de confirmación de :attribute no coincide.',
	'date'                  => 'El campo :attribute no es una fecha válida.',
	'date_format' 	        => 'El campo :attribute no corresponde con el formato :format.',
	'different'             => 'Los campos :attribute y :other deben ser diferentes.',
	'digits'                => 'El campo :attribute debe ser de :digits dígitos.',
	'digits_between'        => 'El campo :attribute debe tener entre :min y :max dígitos.',
	'dimensions'            => 'El campo :attribute no tiene una dimensión válida.',
	'distinct'              => 'El campo :attribute tiene un valor duplicado.',
	'email'                 => 'El formato del :attribute es inválido.',
	'exists'                => 'El campo :attribute seleccionado es inválido.',
	'file'                  => 'El campo :attribute debe ser un archivo.',
	'filled'                => 'El campo :attribute es requerido.',
	'gt'                    => [
		'numeric' => 'El campo :attribute debe ser mayor a :value.',
		'file'    => 'El campo :attribute debe ser mayor a :value kilobytes.',
		'string'  => 'El campo :attribute debe ser mayor a :value caracteres.',
		'array'   => 'El campo :attribute puede tener hasta :value elementos.',
	],
	'gte'                   => [
		'numeric' => 'El campo :attribute debe ser mayor o igual a :value.',
		'file'    => 'El campo :attribute debe ser mayor o igual a :value kilobytes.',
		'string'  => 'El campo :attribute debe ser mayor o igual a :value caracteres.',
		'array'   => 'El campo :attribute puede tener :value elementos o más.',
	],
	'image'                 => 'El campo :attribute debe ser una imagen.',
	'in'                    => 'El campo :attribute seleccionado es inválido.',
	'in_array'              => 'El campo :attribute no existe en :other.',
	'integer'               => 'El campo :attribute debe ser un entero.',
	'ip'                    => 'El campo :attribute debe ser una dirección IP válida.',
	'ipv4'                  => 'El campo :attribute debe ser una dirección IPv4 válida.',
	'ipv6'                  => 'El campo :attribute debe ser una dirección IPv6 válida.',
	'json'                  => 'El campo :attribute debe ser una cadena JSON válida.',
	'lt'                   => [
		'numeric' => 'El campo :attribute debe ser menor a :max.',
		'file'    => 'El campo :attribute debe ser menor a :max kilobytes.',
		'string'  => 'El campo :attribute debe ser menor a :max caracteres.',
		'array'   => 'El campo :attribute puede tener hasta :max elementos.',
	],
	'lte'                   => [
		'numeric' => 'El campo :attribute debe ser menor o igual a :max.',
		'file'    => 'El campo :attribute debe ser menor o igual a :max kilobytes.',
		'string'  => 'El campo :attribute debe ser menor o igual a :max caracteres.',
		'array'   => 'El campo :attribute no puede tener más que :max elementos.',
	],
	'max'                   => [
		'numeric' => 'El campo :attribute debe ser menor a :max.',
		'file'    => 'El campo :attribute debe ser menor a :max kilobytes.',
		'string'  => 'El campo :attribute debe ser menor a :max caracteres.',
		'array'   => 'El campo :attribute puede tener hasta :max elementos.',
	],
	'mimes'                 => 'El campo :attribute debe ser un archivo de tipo: :values.',
	'mimetypes'             => 'El campo :attribute debe ser un archivo de tipo: :values.',
	'min'                   => [
		'numeric' => 'El campo :attribute debe tener al menos :min.',
		'file'    => 'El campo :attribute debe tener al menos :min kilobytes.',
		'string'  => 'El campo :attribute debe tener al menos :min caracteres.',
		'array'   => 'El campo :attribute debe tener al menos :min elementos.',
	],
	'not_in'                => 'El campo :attribute seleccionado es invalido.',
	'not_regex'             => 'El formato del campo :attribute es inválido.',
	'numeric'               => 'El campo :attribute debe ser un número.',
	'present'               => 'El campo :attribute debe estar presente.',
	'regex'                 => 'El formato del campo :attribute es inválido.',
	'required'              => 'El campo :attribute es requerido.',
	'required_if'           => 'El campo :attribute es requerido cuando el campo :other es :value.',
	'required_unless'       => 'El campo :attribute es requerido a menos que :other esté presente en :values.',
	'required_with'         => 'El campo :attribute es requerido cuando :values está presente.',
	'required_with_all'     => 'El campo :attribute es requerido cuando :values está presente.',
	'required_without'      => 'El campo :attribute es requerido cuando :values no está presente.',
	'required_without_all'  => 'El campo :attribute es requerido cuando ningún :values está presente.',
	'same'                  => 'El campo :attribute y :other debe coincidir.',
	'size'                  => [
		'numeric' => 'El campo :attribute debe ser :size.',
		'file'    => 'El campo :attribute debe tener :size kilobytes.',
		'string'  => 'El campo :attribute debe tener :size caracteres.',
		'array'   => 'El campo :attribute debe contener :size elementos.',
	],
	'starts_with'           => 'El :attribute debe empezar con uno de los siguientes valores :values',
	'string'                => 'El campo :attribute debe ser una cadena.',
	'timezone'              => 'El campo :attribute debe ser una zona válida.',
	'unique'                => 'El campo :attribute ya ha sido tomado.',
	'uploaded'              => 'El campo :attribute no ha podido ser cargado.',
	'url'                   => 'El formato de :attribute es inválido.',
	'uuid'                  => 'El :attribute debe ser un UUID valido.',

	/*
	|--------------------------------------------------------------------------
	| Validación del idioma personalizado
	|--------------------------------------------------------------------------
	|
	|	Aquí puede especificar mensajes de validación personalizados para atributos utilizando el
	| convención "attribute.rule" para nombrar las líneas. Esto hace que sea rápido
	| especifique una línea de idioma personalizada específica para una regla de atributo dada.
	|
	*/

	'custom' => [
		'attribute-name' => [
			'rule-name'  => 'custom-message',
		],
	],

	/*
	|--------------------------------------------------------------------------
	| Atributos de validación personalizados
	|--------------------------------------------------------------------------
	|
        | Las siguientes líneas de idioma se utilizan para intercambiar los marcadores de posición de atributo.
        | con algo más fácil de leer, como la dirección de correo electrónico.
        | de "email". Esto simplemente nos ayuda a hacer los mensajes un poco más limpios.
	|
	*/

	'attributes' => [
		'regional_id'           				=> 'regional',
		'region_id' 							=> 'región',
		'director_regional_id' 					=> 'director(a) regional',
		'codigo' 								=> 'código',
		'subdirector_id' 						=> 'subdirector',
		'centro_formacion_id'  					=> 'centro de formación',
		'sector_productivo_id'  				=> 'sector productivo',
		'mesa_tecnica_id' 						=> 'mesa técnica',
		'descripcion'           				=> 'descripción',
		'linea_programatica_id' 				=> 'línea programática',
		'categoria'								=> 'categoría',
		'acronimo' 								=> 'acrónimo',
		'enlace_gruplac' 						=> 'enlace GrupLAC',
		'codigo_minciencias'    				=> 'código Minciencias',
		'categoria_minciencias' 				=> 'categoría Minciencias',
		'year' 									=> 'año',
		'linea_programatica_id' 			    => 'tipo de proyecto',
		'actividad_economica_id'				=> 'actividad económica',
		'linea_tecnologica_id'  				=> 'línea tecnológica',
		'titulo' 								=> 'título',
		'mesa_sectorial_id' 					=> 'mesa sectorial',
		'muestreo' 								=> '¿Cuál es el origen de las muestras con las que se realizarán las actividades de investigación, bioprospección y/o aprovechamiento comercial o industrial?',
		'recoleccion_especimenes' 				=> 'referente a la recollección de especímenes',
		'numero_aprendices'     				=> 'número de aprendices beneficiados',
		'actividades_muestreo'  				=> 'actividad que pretende con la especie nativa',
		'objetivo_muestreo'     				=> 'finalidad de las actividades a realizar con la especie nativa',
		'municipios'            				=> 'nombre de los municipios beneficiados',
		'convocatoria_rol_sennova_id' 			=> 'rol SENNOVA',
		'proyecto_presupuesto_id'     			=> 'rubro presupuestal',
		'descripcion_recursos_dinero' 			=> 'descripción de la destinación del dinero aportado',
		'actividades_transferencia_conocimiento' => 'actividades de transferencia de conocimiento',
		'numero_roles'  						=> 'número de personas',
		'numero_meses' 							=> 'número de meses',
		'resultado_id' 							=> 'resultado',
		'producto_id'           				=> 'producto',
		'actividad_id'          				=> 'actividad',
		'carta_intencion'       				=> 'carta de intención',
		'fecha_inicio'          				=> 'fecha de inicio',
		'fecha_finalizacion'    				=> 'fecha de finalización',
		'numero_documento'      				=> 'número de documento',
		'numero_celular'      					=> 'número de celular',
		'grupo_investigacion_id' 				=> 'grupo de investigación',
		'linea_investigacion_id' 				=> 'línea de investigación',
		'min_fecha_inicio_proyectos' 			=> 'rango de fechas de ejecución de proyectos',
		'max_fecha_finalizacion_proyectos' 		=> 'rango de fechas de ejecución de proyectos',
		'centro_formacion_id'    				=> 'centro de formación',
		'nodo_tecnoparque_id' 					=> 'nodo Tecnoparque',
		'tecnoacademia_linea_tecnoacademia_id'    => 'línea tecnológica',
		'email'                 				=> 'correo electrónico',
		'role_id'               				=> 'rol',
		'trl'                   				=> 'TRL',
		'nit'                   				=> 'NIT',
		'convocatoria_presupuesto_id' 			=> 'uso presupuestal',
		'subtipologia_minciencias_id' 			=> 'subtipología Minciencias',
		'linea_investigacion_id'                => 'línea de investigación',
		'disciplina_subarea_conocimiento_id'    => 'disciplina de la subárea de conocimiento',
		'tematica_estrategica_id'               => 'temáticas estratégicas SENA',
		'red_conocimiento_id'                   => 'red de conocimiento',
		'antecedentes'                        	=> 'antecedentes del proyecto',
		'metodologia'                       	=> 'metodología del proyecto',
		'propuesta_sostenibilidad'              => 'propuesta de sostenibilidad',
		'objetivo_general'                      => 'objetivo general',
		'bibliografia'                          => 'bibliografía',
		'impacto_municipios'                    => 'descripción del beneficio en los municipios',
		'impacto_centro_formacion'              => 'impacto en el centro de formación',
		'relacionado_plan_tecnologico'          => '¿El proyecto se alinea con el plan tecnológico desarrollado por el centro de formación?',
		'relacionado_agendas_competitividad'    => '¿El proyecto se alinea con las Agendas Departamentales de Competitividad e Innovación?',
		'relacionado_mesas_sectoriales'       	=> '¿El proyecto se alinea con las Mesas Sectoriales?',
		'relacionado_tecnoacademia'             => '¿El proyecto se formuló en conjunto con la tecnoacademia?',
		'justificacion_industria_4'             => 'industria 4.0',
		'justificacion_economia_naranja'        => 'economía naranja',
		'justificacion_politica_discapacidad'   => 'Política Institucional para Atención de las Personas con discapacidad',
		'problema_central'                		=> 'problema central',
		'justificacion_problema'                => 'justificación',
		'permission_id'     					=> 'permisos',
		'password'          					=> 'contraseña',
		'justificacion' 						=> 'justificación',
		'tipo_software' 						=> 'tipo de software',
		'tipo_licencia' 						=> 'tipo de licencia',
		'codigo_uso_presupuestal' 				=> 'código del uso presupuestal',
		'nombre_instituciones' 					=> 'Instituciones donde se implementará el programa que tienen Articulación con la Media',
		'old_password' 							=> 'contraseña actual',
		'rol_id' 								=> 'rol',
		'max_meses_ejecucion' 					=> 'fecha de ejecución',
		'mesa_tecnica_sector_productivo_id'     => 'mesa técnica'
	],
];
