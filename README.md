##JUST A STUDY PROJECT
*2015-04-12 first commit
##项目名称修改
*项目拿下去后是以fuckphp的文件夹，将fuckphp修改为juaOL（虽然Apache是不区分大小写的，但统一还是为juaOL）
##忽略文件的一般规则
* .a       # 忽略所有 .a 结尾的文件
* !lib.a    # 但 lib.a 除外
* /TODO     # 仅仅忽略项目根目录下的 TODO 文件，不包括 subdir/TODO
* build/    # 忽略 build/ 目录下的所有文件
* doc/*.txt # 会忽略 doc/notes.txt 但不包括 doc/server/arch.txt
* ？：代表任意的一个字符
* ＊：代表任意数目的字符
* {!ab}：必须不是此类型
* {ab,bb,cx}：代表ab,bb,cx中任一类型即可
* [abc]：代表a,b,c中任一字符即可
* [ ^abc]：代表必须不是a,b,c中任一字符
* 由于git不会加入空目录，所以下面做法会导致tmp不会存在 tmp/*             //忽略tmp文件夹所有文件
* 改下方法，在tmp下也加一个.gitignore,内容为:!.gitignore
