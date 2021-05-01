    
    // Defininicion de los campos
    var tableColumns = [
        {
            name: 'id',
            title: 'ID',
            dataClass: 'text-center',
            sortField: 'id',
            visible : false,
        },
        {
            name: 'titulo',
            title: 'Titulo',
            sortField: 'titulo',
        },
        {
            name: 'name',
            title: 'Author',
            sortField: 'name',
        },
        {
            name: '__actions',
            title: 'Opciones',
            titleClass: 'text-center',
            dataClass: 'text-center',
        }
        ]
    
        //Componente especial para los detalles de cada campo
        Vue.component('my-detail-row', {
            template: [
            '<div class="detail-row ui form" @click="onClick($event)">',
            '<div class="col-md-4">',
             '<div class="inline field">',
            '<label>Nombre Contribuyente: </label>',
            '<span> {{rowData.nombre_cliente_tributador}}</span>',
            '</div><br/>',
            '<div class="inline field">',
            '<label>Nombre Comercial: </label>',
            '<span> {{rowData.nombre_cliente_tributador}}</span>',
            '</div><br/>',
            '<div v-if="rowData.tipo_identificacion == 01"  class="inline field">',
            '<label>Tipo Identificador: </label>',
            '<span> Físico</span>',
            '<br/>',
            '</div>',
            '<div v-if="rowData.tipo_identificacion == 02"  class="inline field">',
            '<label>Tipo Identificador: </label>',
            '<span> Jurídico</span>',
            '<br/>',
            '</div>',
            '<div v-if="rowData.tipo_identificacion == 03"  class="inline field">',
            '<label>Tipo Identificador: </label>',
            '<span> DIMEX</span>',
            '<br/>',
            '</div>',
            '<div v-if="rowData.tipo_identificacion == 04"  class="inline field">',
            '<label>Tipo Identificador: </label>',
            '<span> NITE</span>',
            '<br/>',
            '</div>',
            '<div class="inline field">',
            '<label>Identificación: </label>',
            '<span> {{rowData.cedula_tributador}}</span>',
            '</div><br/>',
                    '</div>', //End Div col-md-4
                    '<div class="col-md-4">',
                     '<div class="inline field">',
            '<label>Razon Social: </label>',
            '<span> {{rowData.razon_social}}</span>',
            '</div><br/>',
                    '<div class="inline field">',
                    '<label>Telefono Empresa: </label>',
                    '<span> {{rowData.telefono_empresa}}</span>',
                    '</div><br/>',
                    '<div class="inline field">',
                    '<label>Dirección Empresa: </label>',
                    '<span> {{rowData.direccion_empresa}}</span>',
                    '</div><br/>',
                    '<div class="inline field">',
                    '<label>Correo Empresa: </label>',
                    '<span> {{rowData.correo_empresa}}</span>',
                    '</div><br/>',
                    '</div>', //End Div col-md-4
                    '<div v-if="!rowData.logo" class="col-md-4">', 
                    '<p>No contiene Logo</p>', 
                    '</div>', //End Div col-md-4
                    '<div v-else class="col-md-4">',
                    '<img width="150" height="150" class="img-responsive" :src="rowData.logo" alt="logo">',
                    '</div>',
                    '</div>',
                    ].join(''),
                    props: {
                        rowData: {
                            type: Object,
                            required: true
                        }
                    },
                    methods: {
                        onClick: function(event) {
                            console.log('Componente detalles de fila: on-click')
                        }
                    },
                })
     
        var vm = new Vue({
            el: '#app',
            data: {
                apiFiltroUrl : '/wiki/api/get',
                searchFor: '',
                fields: tableColumns,
                sortOrder: [{
                    field: 'id',
                    direction: 'asc'
                }],
                multiSort: true,
                perPage: 10,
                paginationComponent: 'vuetable-pagination',
                paginationInfoTemplate: 'แสดง {from} ถึง {to} จากทั้งหมด {total} รายการ',
                itemActions: [
                { name: 'view-item', label: '', icon: 'fas fa-eye', class: 'btn btn-info', extra: {'title': 'Ver', 'data-toggle':"tooltip", 'data-placement': "left"} },
                { name: 'edit-item', label: '', icon: 'fas fa-edit', class: 'btn btn-warning', extra: {'title': 'Modificar', 'data-toggle':"tooltip", 'data-placement': "center"} },
                { name: 'delete-item', label: '', icon: 'fas fa-trash', class: 'btn btn-danger', extra: {title: 'Eliminar', 'data-toggle':"tooltip", 'data-placement': "right" }},
             ],
                moreParams: [],
               
    
            }, 
            watch: {
                'perPage': function(val, oldVal) {
                    //Refresca la tabla cuando se cambia el valor perpage
                    this.$broadcast('vuetable:refresh');
                },
                'paginationComponent': function(val, oldVal) {
                    //Cuando se cambia el componente de paginacion
                    this.$broadcast('vuetable:load-success', this.$refs.vuetable.tablePagination);
                    this.paginationConfig(this.paginationComponent);
                }
                ,
                apiFiltroUrl : function(){
                    this.$refs.vuetable.$dispatch('vuetable:reload');
                }
            },
            methods: {
          
            
                /**
                 * Otras funciones
                 */
                 setFilter: function() {
                    this.moreParams = [
                    'filter=' + this.searchFor
                    ];
                    this.$nextTick(function() {
                        this.$broadcast('vuetable:refresh');
                    });
                },
                resetFilter: function() {
                    this.searchFor = '';
                    this.setFilter();
                },
              preg_quote: function( str ) {
                    return (str+'').replace(/([\\\.\+\*\?\[\^\]\$\(\)\{\}\=\!\<\>\|\:])/g, "\\$1");
                },
                highlight: function(needle, haystack) {
                   return haystack.replace(
                        new RegExp('(' + this.preg_quote(needle) + ')', 'ig'),
                        '$1'
                    );
                },
             rowClassCB: function(data, index) {
                return (index % 2) === 0 ? 'positive' : '';
            },
            paginationConfig: function(componentName) {
                console.log('Configurando paginacion : ', componentName)
                if (componentName == 'vuetable-pagination') {
                    this.$broadcast('vuetable-pagination:set-options', {
                        wrapperClass: 'pagination',
                        icons: { first: '', prev: '', next: '', last: ''},
                        activeClass: 'active',
                        linkClass: 'btn btn-default',
                        pageClass: 'btn btn-default'
                    })
                }
                if (componentName == 'vuetable-pagination-dropdown') {
                    this.$broadcast('vuetable-pagination:set-options', {
                        wrapperClass: 'form-inline',
                        icons: { prev: 'glyphicon glyphicon-chevron-left', next: 'glyphicon glyphicon-chevron-right' },
                        dropdownClass: 'form-control'
                    })
                }
            },
            refreshTable : function (){
                  // Refresca la tabla * reload fuerza su carga
                  this.$refs.vuetable.$dispatch('vuetable:refresh');
              },
    
          },
          events: {
            'vuetable:action': function(action, data) {
    
                    // Obtiene una copia de esta instancia de Vue
                    var instance = this; 
    
                   
                    if (action == 'view-item'){
                        var win = window.open('/post/ver/'+data.id,"_self");
                        win.focus();
                    }
    
                    //Si se ejecuta ver un item
                    if (action == 'edit-item') 
                    {
                        var win = window.open('/post/editar/'+data.id,"_self");
                        win.focus();
                    } 
    
                    //Si se ejecuta editar un item
                    if (action == 'delete-item') 
                    {   
                        Swal.fire({
                            title: 'Estas Seguro?',
                            text: "Esta publicacion sera eliminada",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, eliminar',
                            cancelButtonText: 'Cancelar'
                          }).then((result) => {
                            if (result.isConfirmed) {

                                instance.$http.get('/post/eliminar/'+data.id).then(response => {
                                    instance.refreshTable();
                                    Swal.fire(
                                        'Archivo eliminado',
                                        '',
                                        'success'
                                    );
                                },
                                response => {
                                    Swal.fire(
                                        'Ha ocurrido un error',
                                        '',
                                        'error'
                                    );
                                });
                              
                            }
                          })
                    }
    
                } 
    
    
            },
            'vuetable:load-success': function(response) {
                var data = response.data.data
            },
            'vuetable:load-error': function(response) {
                if (response.status == 400) 
                {
                    toastr.error("Algo ha salido mal!\n" + response.data.message, "Error");
                } else 
                {
                    toastr.error("Error al comunicarse con el servidor , intentelo de nuevo", "Error");
                }
            }
        
    });
    