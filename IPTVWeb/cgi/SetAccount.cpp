#include <stdio.h>
#include <stdlib.h>
#include <string>
using namespace std;
int main( void )
{
        fprintf( stdout, "Content-type:text/html\n\n");
        fprintf( stdout, "<html><title>get</title>\n");

        string username = "";
        string password = "";
        if( getenv("QUERY_STRING" ) )
        {
                char* queryStr = getenv("QUERY_STRING");
                if(scanf(queryStr,"username=%s&password=%s",&username,&password) == 2)
                {
                    fprintf( stdout, username + "|" + password);
                }
        }
        else
        {
                fprintf( stdout, "(NULL)\n" );
        }

        fprintf( stdout, "</html>\n" );
        return 0;
}



