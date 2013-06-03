Symfony2の勉強の為のrepository
========================

2013.05.25渋谷のVOYAGE GROUP AJITOで行われた[symfony2勉強会][1]に参加させていただきました。これまでWebアプリの開発をしたことが無く、PHPはおろかsymfonyの知識は殆どなかった為、後半のワークショップでは何度も質問をしながら（親切に指導していただきありがとうございました、そのおかげで）なんとか最後までたどり着きましたが、終了後も頭の中の混乱は整理できず、ワークショップの復習をしようとこのrepositoryを作りました。  
おさらいしながら節目節目でpushし、何をしたら、どのファイルがどう変わるのかの履歴を残した感じです。  
ワークショップでは「Blog」アプリの開発というテーマでしたが、丸ごと真似すると自分が何が分かってないのか分からないだろう思い、ここでは「To Do List」アプリと若干アレンジしています。しかし、内容はほぼワークショップと同じです。(そこまではアレンジできませんでした。)  
もしsymfonyというキーワドでこのページに辿り着かれた、私と同じように勉強中の方は、[講師であったokaponさんが作られているチュートリアル][2]を参考にされると良いと思います。そして、何をしたら、どのファイルがどの様に書き換わるのかを確認したい場合に、本repositoryの各commitを参照されてはいかがでしょうか。

commit:1) composerを使ってsymfony2.2.1をインストールした状態
----------------------------------------------------
[composer][3]を使ってsymfony2.2.1をインストールした直後の状態をpushしています。不要なファイルがたくさんあると思うので、もう少し理解が深まってから、不要なファイルを削除します。

commit:2) バンドル(My/ToDoListBundle)を生成 
----------------------------------------------------
<code>php app/console generate:bundle</code>というコマンドを使ってバンドル生成後、pushました。

commit:3) DBへデータを登録する為のエンティティ(POSTエンティティ)を生成 
----------------------------------------------------
<code>php app/console generate:doctrine:entity</code>というコマンドを使ってPOSTエンティティを生成後、pushました。

commit:4) ToDoList画面を作成する為にコントローラとテンプレートを追加
----------------------------------------------------
項目一覧画面です。下記を行いpushしました。
  1. routingを行うためcontrollerにannotationを設定
  2. <code>@Template()</code>の参照先となるファイルを作成

commit:5) 詳細内容表示画面を作成する為にコントローラとテンプレートを作成
----------------------------------------------------
各項目の詳細内容表示画面です。下記を行いpushしました。
  1. routingを行うためcontrollerにannotationを設定
  2. <code>@Template()</code>の参照先となるファイルを作成

commit:6) ToDoList画面の各要素と詳細内容画面をリンクさせる
----------------------------------------------------
<code>@Route</code>の各項目に<code>name="○○○"</code>という名前を付け、html.twig内でリンクさせる処理を追加し、pushしました。

commit:7) ベースのテンプレートを作り、ToDoList画面と詳細内容表示画面に継承する
----------------------------------------------------
項目一覧画面、項目詳細表示画面とで共通するheaderやfooter部分を、別のテンプレートに記述。そしてそれを、項目一覧画面、項目詳細表示画面のれぞれのに継承する処理を行い、pushしました。

commit:8) bootstrapを使って見栄えを良くする
----------------------------------------------------
[bootstrap][4]、初めて知りました。この便利なstylesheetを使って、見栄えを良くしています。その後pushしました。

commit:9) 新規アイテム追加機能を追加し、入力値のバリデーションを行う
----------------------------------------------------
下記を行いpushしました。
  1. 新規アイテム追加の為のcontrollerを追加
  2. 項目一覧テンプレートに新規アイテム追加用のボタンを追加
  3. Entity/Post.php内でバリデーションを設定

commit:10) アイテムの削除機能を追加
----------------------------------------------------
下記を行いpushしました。
  1. アイテムの削除の為のcontrollerを追加
  2. 項目一覧テンプレートにアイテムの削除用のボタンを追加

commit:11) アイテムの編集機能を追加
----------------------------------------------------
下記を行いpushしました。
  1. アイテムの編集の為のcontrollerを追加
  2. 新規作成用テンプレートに対し、新規作成の場合とアイテムの編集の場合とで表示される内容が切り替わる様に変更。

commit:12) このmdとpdfをコミット
----------------------------------------------------
このReadme.mdと、symfony2_ToDoList.pdfをコミットしました。
  * Readme.md - markdown形式のファイルは初めて書きました。このファイルです。
  * [symfony2_ToDoList.pdf][5] - windowのPCしか持っていないので、xamppをインストールし色々と設定しています。その過程と、このrepositoryを作る際に行った作業のメモをpdfにしています。

### 今後は、必要無さそうなファイルを削除してcommitします。
### That's all.

[1]:  http://www.symfony.gr.jp/events/20130501-symfony-study8
[2]:  https://github.com/okapon/symfony-workshop/wiki
[3]:  http://getcomposer.org/
[4]:  http://twitter.github.io/bootstrap/getting-started.html
[5]:  https://github.com/okagen/Symfony/blob/master/symfony2_ToDoList.pdf
