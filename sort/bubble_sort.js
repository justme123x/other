let arr = [1, 5, 3, 6, 8, 2, 4, 10];
let len = arr.length;
let num = 0;
for (let i = 0; i < len; i++) {
    for (let j = len - 1; j > i; j--) {
        if (arr[i] < arr[j]) {
            let x = arr[i];
            arr[i] = arr[j];
            arr[j] = x;
        }
        num++;
    }
}
let str = '数组长度' + len + ',冒泡次数' + num + ' ' + len + '(' + len + '-1)/2'
console.log(str);
console.log(arr);