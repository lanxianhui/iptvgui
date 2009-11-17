/* 
 * File:   main.c
 * Author: LangYu
 *
 * Created on November 17, 2009, 3:54 PM
 */

#include <stdio.h>
#include <stdlib.h>

/*
 * 
 */
int g = 10;

int main(int argc, char** argv) {
    int i = 0;
    void f1();
    f1();
    printf(" after first call \n");
    f1();
    printf(" after second call \n");
    f1();
    printf(" after third call \n");
    return (EXIT_SUCCESS);
}

void f1(){
    static int k = 0;
    int j = 20;
    printf("Value of k %d j %d",k,j);
    k = k+10;
}

