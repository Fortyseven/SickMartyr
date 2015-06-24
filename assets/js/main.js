// onload is in index twig

$( window ).resize( function ()
                    {
                        resizeElements();
                    } );

function resizeElements()
{
    var vb = $( "#VideoBlock" );
    vb.height( vb.width() * 0.60 );
}

function FetchGoogleImageForTerm( title )
{
    $.ajax( {
                url: "https://ajax.googleapis.com/ajax/services/search/images?v=1.0&q=" +
                     escape( title ),
                dataType:      "jsonp",
                jsonpCallback: "jsonprec",
                success:       function ( data, textStatus )
                {
                    $( "#VideoBlock" ).css( 'background-image',
                                            "url(" +
                                            data.responseData.results[ 0 ].url +
                                            ")" );
                },
                timeout:       500,
                error:         function ( XHR )
                {
                    console.log( "whoopps", XHR );
                }
            } );
}
