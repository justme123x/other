#include <stdio.h>

int main(){
    int arr[8] = {1, 5, 3, 6, 8, 2, 4, 10};
    int len = sizeof(arr)/sizeof(arr[0]);
    int x;
    int num =0;
    for (int i=0; i<len; i++) {
        for (int j=i+1; j<len; j++) {
            if(arr[i] < arr[j]){
                x = arr[i];
                arr[i]= arr[j];
                arr[j] = x;
            }
            num++;
        }
    }

    for (int i=0; i<len; i++) {
        printf("arr[%d]=>%d \n",i,arr[i]);
    }
    printf("数组长度%d,冒泡次数%d %d(%d-1)/2\n",len,num,len,len);
    return 0;
}
