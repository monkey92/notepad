## 

1. 批量删除key
```sh

# -a 密码
# -n 选择的库
redis-cli -a c5game@888 -n 1 keys "*paint_info_*" | xargs redis-cli -a c5game@888 -n 1 del

```


##



##