PHP實作測試 (A版) - 簡易選課系統
請注意, 本文件為獲得面試資格之求職者專用, 請勿外流測驗說明

測驗說明: 
測驗採在家線下進行, 面談前完成

撰寫"符合標準"之restful API, 並符合下方陳述之功能與必要條件

此系統藉由API來進行資料操作, 不須網頁介面

可自由參考網路資料, 但請不要複製貼上其他人的程式碼

測驗交付: 
於面談前將程式碼推送至Github, 並來信提供連結

功能與實作說明

系統角色與關係:
一門課只有一名老師, 一個老師可以教多門課
一門課有多個學生, 一個學生能上多門課
一門課只有一名助教, 由學生擔任, 但未來可能會有多名

系統功能說明:
學生建立/修改/刪除
課程建立/修改/刪除
老師建立/修改/刪除
學生選課/刪除選課
課程設定/異動設定授課老師
取得課程資料
取得單一課程學生清單
助教設定

資料庫:
使用MySQL
資料表設計須符合"正規化"規範, 並正確設定"索引"與"表關聯"
資料庫建立使用 Laravel db migration機制

功能開發:
使用Laravel framework進行restful API開發, 正確使用route, service, repository, orm
程式碼須符合PSR-2, PSR-6規範; API需符合”restful規範”
須思考事件間的關聯 (ex:刪除課程, 是否需要同時刪除修課清單? 是否會有重複修課的問題?)
其他加分項目: JWT token驗證, 資安驗證, OOP設計, unit test撰寫, 通過phpmd檢測   (optional 非必要)
