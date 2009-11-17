/* 
 * File:   main.c
 * Author: LangYu
 *
 * Created on November 17, 2009, 4:33 PM
 */

#include <stdio.h>
#include <stdlib.h>

/*
 * 
 */
int main(int argc, char** argv) {
    int number = 0;
    int *pointer = NULL;

    number = 10;
    pointer = &number;

    printf("\nPointer's value: %p",pointer);
    printf("\nValue pointed to: %d\n",*pointer);

    int a[15];
    int *b;
    int *c;
    int i;
    for(i = 0; i < 5; i++){
        a[i] = i;
    }
    for(i = 0; i < 5; i++){
        printf("Value in array %d\n",a[i]);
    }

    b = a;
    b++;
    *b = 4;
    b++;
    *b = 6;
    b++;
    *b = 8;
    b++;
    *b = 10;
    b++;
    *b = 12;

    printf("after\n\n\n");
    for( i = 0; i < 5; i++ ){
        printf("Value in array %d\n",a[i]);
    }
    return (EXIT_SUCCESS);
}

