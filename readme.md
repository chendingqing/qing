## 点餐日志

### day1



## 需求

### 平台端：

##### 商家分类管理 

##### 商家管理 

##### 商家审核

### 商户端

##### 商家注册

## 要求

##### 商家注册时，同步填写商家信息，商家账号和密码 

##### 商家注册后，需要平台审核通过，账号才能使用

##### 平台可以直接添加商家信息和账户，默认已审核通过

### 实现步骤

1.平台端

创建数据库，数据表，

2.在视图里创建视图

3.在平台商家管理里添加一个商家审核同时可以添加商家店铺默认状态为审核通过

4.在视图里在创建一个商家平台

创建商家后台模板

5 .在商家平台创建商家注册视图

6.在商家店铺注册时同时添加商家用户信息

7.商家注册后默认商家状态为待审核,必须通过平台端的审核后才能开通商铺

### 遇见的问题

1.商家注册时添加出现多字段没有默认值

解决方案 ：在数据库里给字段添加默认值

2.在编辑删除店铺信息时出现了找不到路径 

解决方案：跟着路劲找错误

3.删除店铺是图片不能删除

解决方案：路径没写对，找对路劲 在删除图片路径前加一个public_path



# day2

### 开发任务

- 完善day1的功能，使用事务保证商家信息和账号同时注册成功
- 平台：平台管理员账号管理
- 平台：管理员登录和注销功能，修改个人密码(参考微信修改密码功能)
- 平台：商户账号管理，重置商户密码
- 商户端：商户登录和注销功能，修改个人密码
- 修改个人密码需要用到验证密码功能,
- 商户状态不是1正常，则商家账号不能登录

###  实现步骤

1.商家店铺注册时 同时注册成功 如果有一个没添加成功要事务回滚

```php
DB::transaction(function () {
 数据执行语句；
});
```

2. 在平台端里  添加管理员管理做一个管理员表的curd 

   在平台添加一个登陆页面

   登陆返回必须是平台模版的管理首页 注意：平台模板和商户模板不能是同一个模板，如果要用一个模本必须要分目录创建默认模板

   3.在平台端 创建商家用户管理 添加一个重置密码功能

   ```php
       if (Hash::check($request->post('password'), $admin->password)) {
                   $request->user()->fill([
                       'password' => Hash::make($request->post('re_password'))
                   ])->save();
                   session()->flash("success", "密码修改成功");
                   return redirect()->route('admin.index');
               } else {
                   session()->flash("success", "旧密码不正确");
                   return redirect()->back()->withInput();
               }xxxxxxxxxx    public function update(Request $request)    {        // Validate the new password length...//接收当前输入旧密码  与数据库的旧密码进行对比       if (Hash::check('plain-text', $hashedPassword)) {                 $request->user()->fill([            'password' => Hash::make($request->newPassword)        ])->save();    }}     }
   ```

3. 商户登录注册

   登录成功后再首页显示当前登录用户    引用Auth 显示当前登录用户名

   ```php
   {{\Illuminate\Support\Facades\Auth::guard('admin')->user()->name}}
   ```

   

   4.在商户登录时进行判断当前登录用户的状态，如过商家用户状态为禁用就不能登录

   ```php
                  if(Auth::user()->status===0){
                          Auth::logout();
                          session()->flash("success","商家状态已警用");
                          return redirect()->back()->withInput();
                      }
   ```

   

# 遇见的问题

登录成功后跳转路径不对

解决方案：因为自己平台和商户端用的一个模板导致跳转路径出错

总结：小错误不断，不细心



## day3

### 开发任务

商户端 
\- 菜品分类管理 
\- 菜品管理 
要求 
\- 一个商户只能有且仅有一个默认菜品分类 
\- 只能删除空菜品分类 
\- 必须登录才能管理商户后台（使用中间件实现） 
\- 可以按菜品分类显示该分类下的菜品列表 
\- 可以根据条件（按菜品名称和价格区间）搜索菜品

### 实现步骤   注意

1. 添加一个菜品分类管理 

   ##### 注意每个商家只能有一个默认分类 

   添加分类是根据登录的商家进行添加

2. 删除分类时 进行怕判断 分类下是否有菜品 如果有菜品不能删除

3. 商家必须登录都才能实现所有功能 在控制器里添加一个base控制器判断是否有用户登录  模型必须继承    Authenticatable    每个控制器在继承base控制器

4. 在菜品类列表添加一类导航条 添加几个搜索表单 

5. 控制器 接收搜索值进行数据条件查找

   

### 遇见的困难

# day4



### 开发任务



## 优化 

#### 将网站图片上传到阿里云OSS对象存储服务，以减轻服务器压力 

####  使用webuploder图片上传插件，提升用户上传图片体验



### 平台 

#### 平台活动管理（活动列表可按条件筛选 未开始/进行中/已结束 的活动） 

#### 活动内容使用ueditor内容编辑器





### 商户端 

####  查看平台活动（活动列表和活动详情） 

####  活动列表不显示已结束的活动





## 实现步骤

图片上传阿里云

1.修改配置

```php
 //添加自己的阿里云oss

'oss' => [
                'driver'        => 'oss',
                'access_id'     => 'LTAIkutC9HFgfFDr',
                'access_key'    => 'WQeqwOPWwcuKhgMwdGF9BdbcyvfokR',
                'bucket'        => 'elm0325',
                'endpoint'      => 'oss-cn-shenzhen.aliyuncs.com',
```

```php
env 下面添加自己地址
ALIYUN_OSS_URL=https://elm0325.oss-cn-shenzhen.aliyuncs.com
ACCESS_ID=LTAIkutC9HFgfFDr
ACCESS_KEY=WQeqwOPWwcuKhgMwdGF9BdbcyvfokR
BUCKET=elm0325
ENDPOINT=oss-cn-shenzhen.aliyuncs.com


```

2. 图片上传 类型选择 OSS类型  显示在图片路径前添加 地址

   

3. uediter  文档步骤实行

4. 在平台上添加活动 

   在平台添加或动查询 

   ```php
     $date= date(now());
           $time=$request->get('status');
           if($time==-1){
               $query->where("start_time",'>=',$date);
           }
           if($time==1){
               $query->where("start_time",'<=',$date)->where("end_time",'<=',$date);
           }
           if($time==2){
               $query->where("end_time",'<=',$date);
           }
   ```

5. 在商家店铺查看正在进行中的活动 不显示已结束活动    在显示活动时 判断结束时间是否大小于当前时间

6. webuploader  参照视频做  

   下载配置文件到public下

   引入视图而文件 

   引入视图所需要的样式 js css 

   在写 ajax 代码进行图片上传

   在控制器添加一个方法接收值 再用ajax 传值到表单中

   在视图里添加一个隐藏的表单  

总结：不细心 不细心 ，小错误不断

