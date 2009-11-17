/* 
 * File:   main.c
 * Author: LangYu
 *
 * Created on November 18, 2009, 12:57 AM
 */

#include <stdio.h>
#include <stdlib.h>
#include <stdarg.h>

/*
 * 
 */
double average(double v1, double v2,...);

int main(int argc, char** argv) {
    double Val1 = 10.5, Val2 = 2.5;
    int num1 = 6, num2 = 5;
    long num3 = 12, num4 = 20;

    printf("\n Average = %lf",average(Val1,3.5,Val2,4.5,0.0));
    printf("\n Average = %lf",average(1.0,2.0,0.0));
    printf("\n Average = %lf\n",average((double)num2,Val2,(double)num1,(double)num4,(double)num3,0.0));
    return (EXIT_SUCCESS);
}

double average(double v1,double v2,...){
    va_list parg;
    double sum = v1 + v2;
    double value = 0;
    int count = 2;

    va_start(parg,v2);

    while((value = va_arg(parg,double))!= 0.0){
        sum += value;
        count++;
    }
    va_end(parg);
    return sum/count;
}

