/* 
 * File:   main.c
 * Author: LangYu
 *
 * Created on November 18, 2009, 12:53 AM
 */

#include <stdio.h>
#include <stdlib.h>

/*
 * 
 */
int main(int argc, char** argv) {
    printf("Program Name: %s\n",argv[0]);
    int i;
    for( i = 1; i < argc; i++ )
        printf("\nArgument %d: %s",i,argv[1]);
    return (EXIT_SUCCESS);
}

