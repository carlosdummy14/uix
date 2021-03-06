(function() {

    jQuery( function( $ ){
        $( document ).on( 'change', '.toggle-checkbox', function( e ){
            var clicked     = $( this ),
                parent      = clicked.closest( '.uix-section-content' ),                
                toggleAll   = parent.find( '[data-toggle-all="true"]' ),
                allcount    = parent.find( '.uix-control .switch > input' ).not( toggleAll ).length,
                tottlecount = parent.find( '.uix-control .switch > input:checked' ).not( toggleAll ).length;

            if( clicked.is(':checked') ){
                clicked.parent().addClass( 'active' );
                if( allcount === tottlecount ){
                   toggleAll.prop( 'checked', true ).parent().addClass( 'active' );
                }

            }else{
                clicked.parent().removeClass( 'active' );
                if( toggleAll.length ){
                    toggleAll.prop( 'checked', false ).parent().removeClass( 'active' );
                }
            }

        } );
        $( document ).on( 'uix.init', function() {
            $('.toggle-checkbox').each( function(){
                var box = $( this ),
                    val = box.data('value');

                if( val === 1 ){
                    box.prop( 'checked', true ).data('value', null).parent().addClass('active');
                }
            });
            //$('.uix-control .toggle-checkbox').trigger('change');
        });
        $( document ).on('change', '[data-toggle-all="true"]', function(e){
            var clicked = $( this ),
                parent = clicked.closest( '.uix-section-content' );
                parent.find('.uix-control .switch > input').not(this).prop('checked', this.checked).trigger('change');
        });

    });



})( jQuery );