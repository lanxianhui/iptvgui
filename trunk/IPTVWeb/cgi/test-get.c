#include <stdio.h>
#include <stdlib.h>

int main( void )
{
        fprintf( stdout, "Content-type:text/html\n\n");
        fprintf( stdout, "<html><title>get</title>\n");

        if( getenv("QUERY_STRING" ) )
        {
                fprintf( stdout, getenv("QUERY_STRING" ) );
        }
        else
        {
                fprintf( stdout, "(NULL)\n" );
        }

        fprintf( stdout, "</html>\n" );
        return 0;
}
