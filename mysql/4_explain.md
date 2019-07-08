
[参考](https://segmentfault.com/a/1190000008131735)


## explain 列

id: SELECT 查询的标识符. 每个 SELECT 都会自动分配一个唯一的标识符.

select_type: SELECT 查询的类型.

table: 查询的是哪个表

partitions: 匹配的分区

type: join 类型

possible_keys: 此次查询中可能选用的索引

key: 此次查询中确切使用到的索引.

ref: 哪个字段或常数与 key 一起被使用

rows: 显示此查询一共扫描了多少行. 这个是一个估计值.

filtered: 表示此查询条件所过滤的数据的百分比

extra: 额外的信息


## select_typ列

select_type 表示了查询的类型, 它的常用取值有:

SIMPLE, 表示此查询不包含 UNION 查询或子查询

PRIMARY, 表示此查询是最外层的查询

UNION, 表示此查询是 UNION 的第二或随后的查询

DEPENDENT UNION, UNION 中的第二个或后面的查询语句, 取决于外面的查询

UNION RESULT, UNION 的结果

SUBQUERY, 子查询中的第一个 SELECT

DEPENDENT SUBQUERY: 子查询中的第一个 SELECT, 取决于外面的查询. 即子查询依赖于外层查询的结果.


## type列

type 常用的取值有:

system: 表中只有一条数据. 这个类型是特殊的 const 类型.
const: 针对主键或唯一索引的等值查询扫描, 最多只返回一行数据. const 查询速度非常快, 因为它仅仅读取一次即可.
eq_ref: 此类型通常出现在多表的 join 查询, 表示对于前表的每一个结果, 都只能匹配到后表的一行结果. 并且查询的比较操作通常是 =, 查询效率较高. 

ref: 此类型通常出现在多表的 join 查询, 针对于非唯一或非主键索引, 或者是使用了 最左前缀 规则索引的查询. 

range: 表示使用索引范围查询, 通过索引字段范围获取表中部分数据记录. 这个类型通常出现在 =, <>, >, >=, <, <=, IS NULL, <=>, BETWEEN, IN() 操作中.
当 type 是 range 时, 那么 EXPLAIN 输出的 ref 字段为 NULL, 并且 key_len 字段是此次查询中使用到的索引的最长的那个.

index: 表示全索引扫描(full index scan), 和 ALL 类型类似, 只不过 ALL 类型是全表扫描, 而 index 类型则仅仅扫描所有的索引, 而不扫描数据.
index 类型通常出现在: 所要查询的数据直接在索引树中就可以获取到, 而不需要扫描数据. 当是这种情况时, Extra 字段 会显示 Using index.

ALL: 表示全表扫描, 这个类型的查询是性能最差的查询之一. 通常来说, 我们的查询不应该出现 ALL 类型的查询, 因为这样的查询在数据量大的情况下, 对数据库的性能是巨大的灾难. 如一个查询是 ALL 类型查询, 那么一般来说可以对相应的字段添加索引来避免.
下面是一个全表扫描的例子, 可以看到, 在全表扫描时, possible_keys 和 key 字段都是 NULL, 表示没有使用到索引, 并且 rows 十分巨大, 因此整个查询效率是十分低下的.

通常来说, 不同的 type 类型的性能关系如下:
ALL < index < range ~ index_merge < ref < eq_ref < const < system



## possible_keys

possible_keys 表示 MySQL 在查询时, 能够使用到的索引. 注意, 即使有些索引在 possible_keys 中出现, 但是并不表示此索引会真正地被 MySQL 使用到. MySQL 在查询时具体使用了哪些索引, 由 key 字段决定.

## key

此字段是 MySQL 在当前查询时所真正使用到的索引.


## key_len
表示查询优化器使用了索引的字节数. 这个字段可以评估组合索引是否完全被使用, 或只有最左部分字段被使用到.
key_len 的计算规则如下:

字符串

    char(n): n 字节长度
    varchar(n): 如果是 utf8 编码, 则是 3 n + 2字节; 如果是 utf8mb4 编码, 则是 4 n + 2 字节.

数值类型:

    TINYINT: 1字节

    SMALLINT: 2字节

    MEDIUMINT: 3字节

INT: 4字节

    BIGINT: 8字节

时间类型

    DATE: 3字节

    TIMESTAMP: 4字节

    DATETIME: 8字节

字段属性
    
    NULL 属性 占用一个字节. 如果一个字段是 NOT NULL 的, 则没有此属性
    
    









