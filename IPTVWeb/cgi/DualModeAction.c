#include <stdio.h>
#include <stdlib.h>

int main( void )
{
        int i, n;
        fprintf( stdout, "Content-type:text/html\n\n" );

        fprintf( stdout, "<html><title>post</title>" );
        if( getenv("CONTENT_LENGTH") )
        {
                n = atoi( getenv("CONTENT_LENGTH") );
        }
        else
        {
                n = 0;
        fprintf( stdout, "(NULL)" );
        }

        for( i=0; i<n; i++ )
        {
                fputc( getc(stdin), stdout );
        }

        fprintf( stdout, "\n</html>\n" );
        return 0;
}
