/* 
 * File:   main.c
 * Author: LangYu
 *
 * Created on November 17, 2009, 4:04 PM
 */

#include <stdio.h>
#include <stdlib.h>

/*
 * 
 */
void test1(void){
    int count = 0;
    printf("\ntest1 count = %d ",++count);
}

void test2(void){
    static int count = 0;
    printf("\ntest2 count = %d ",++count);
}

int main(int argc, char** argv) {
    int i;
    for(i = 0; i < 5; i++ ){
        test1();
        test2();
    }
    return (EXIT_SUCCESS);
}

