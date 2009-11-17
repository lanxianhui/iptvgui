/* 
 * File:   main.c
 * Author: LangYu
 *
 * Created on November 17, 2009, 4:08 PM
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
    printf("\nnumber's address:%p",&number);
    printf("\nnumber's value: %d\n\n",number);

    long a = 1L;
    long b = 2L;
    long c = 3L;

    double d = 4.0;
    double e = 5.0;
    double f = 6.0;

    printf("A variable of type long occupies %d bytes.",sizeof(long));
    printf("\nHere are the addresses of some variables of type long:");
    printf("\nThe address of a is: %p The address of b is: %p",&a,&b);
    printf("\nThe address of c is: %p",&c);
    printf("\n\nA variable of type double occupies %d bytes.",sizeof(double));
    printf("\nHere are the addresses of some variables of type double:");
    printf("\nThe address of d is: %p The address of e is: %p",&d,&e);
    printf("\nThe address of f is: %p\n",&f);
    return (EXIT_SUCCESS);
}

