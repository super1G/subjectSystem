<template>
    <div class="album py-5 bg-light">
        
        
        <div class="container">
            <div class="row justify-content-start">
                    <div class="col-1">
                        <h1>ID</h1>
                    </div>
                    <div class="col-2">
                        <h1>名字</h1>
                    </div>
                    <div class="col-3">
                        <h2>生日</h2>
                    </div>
                    <div class="col-3">
                        <p>備註</p>
                    </div>
                    
                    <hr>
                </div>
            <div v-for="(student) in students.data" v-bind:key="student.id">
               
                <div class="row justify-content-start">
                    <div class="col-1">
                        <h1>{{ student.id }}</h1>
                    </div>
                    <div class="col-2">
                        <h1>{{ student.name }}</h1>
                    </div>
                    <div class="col-3">
                        <h2>{{ student.birthday }}</h2>
                    </div>
                    <div class="col-3">
                        <p>{{ student.description}}</p>
                    </div>
                    
                    <button class="btn btn-xs btn-primary" @click="modify(student)">修改</button>
                    <button class="btn btn-xs btn-danger" @click="remove(student.id)">刪除</button>
                    <hr>
                </div>
            
            </div>

            <form>
                <div class="mb-3">
                    <label for="inputName" class="form-label">名字</label>
                    <input v-model="student.name" type="text" class="form-control" id="inputName" aria-describedby="nameHelp">
                    <div id="nameHelp" class="form-text">輸入名字</div>
                </div>
                <div class="mb-3">
                    <label for="InputDate" class="form-label">生日</label>
                    <input v-model="student.birthday" type="date" class="form-control" id="InputDate" aria-describedby="DateHelp">
                    <div id="DateHelp" class="form-text">非必填</div>
                </div>
                <div class="mb-3">
                    <label for="InputDescription" class="form-label">備註</label>
                    <input v-model="student.description" type="text" class="form-control" id="InputDescription" aria-describedby="DescriptionHelp">
                    <div id="DescriptionHelp" class="form-text">非必填</div>
                </div>
                
                

                

                <div class="form-group">
                    <div v-if="isSave">
                        <button @click.prevent="save">儲存</button>
                        <button @click.prevent="cancel">取消</button>
                    </div>
                    <button v-else @click.prevent="publish">發佈</button>
                </div>
            </form>
        </div>
        

        
         
        
<!-- 
        {{isOK?'NO':'YES'}}
        
        <h1>Trying out Vue.js</h1>
        <p>{{ message }}</p>
        <button @click="reverseMessage()">Reverse Message</button>
        <p v-if="isOK">{{ nowmessage }}</p>
         <button  @click="copyChange()">文字改變</button>
        <button  @click="handleChange()">文字顯示</button>

        <input v-model="message" placeholder="edit me">
        <p>Message is: {{ message }}</p>  

        <div :class="[{'active':isActive},errorCls]">123</div>
        {{type}} -->
    </div>
    

</template>


   
<script>
export default {
    
    data() {
        
        
        return {
            isSave: false,
            students: [],
            student: {
                id:null,
                name: '',
                birthday: '',
                description: ''
                
            }
            // type:'names',

            // posts: [],
            // student: {
            //     id: null,
            //     title: '12',
            //     body: '334'
            // },
            // number:100,
            // isOK:true,
            // texts:'123,456',
            // message: "Laura is awesome!",
            // nowmessage:"",

            // isActive:true,
            // errorCls:'error'
        }
        
    },
     methods: {
         init: function () {
            let self = this;
            axios.get('/api/students')
                .then(function (response) {
                    self.students  = response.data;
                   
                    console.log(" self.students");
                    console.log( self.students);
                    console.log("member");
                    console.log(self.member);
                    console.log("SUCCESS");
                })
                .catch(function (response) {
                    console.log(response);
                    console.log("ERROR");
                });
        },
        publish: function () {
            // 
            let self = this;
            axios.post('/api/students', this.student)
                .then(function (response) {
                    if (response.data['ok']) {
                        self.init();
                        
                        this.student = {id: null, name: '', birthday: '',description: ''};
                    }
                })
                .catch(function (response) {
                    console.log(response)
                });
        },

        modify: function (student) {
            location.href = "#form";
            this.student.id = student.id;
            this.student.name = student.name;
            this.student.birthday = student.birthday;
            this.student.description = student.description;
            this.isSave = true;
            console.log(this.student);
        }, 
         save: function () {
             
            let self = this;
            axios.patch('/api/students/'+this.student.id ,{name:this.student.name, birthday:this.student.birthday,description:this.student.description} )
                .then(function (response) {
                    if (response.data['ok']) {
                        self.init();
                        self.isSave = false;
                        this.student = {id: null, name: '', birthday: '',description: ''};
                    }
                    console.log(response);
                })
                .catch(function (response) {
                    console.log(response);
                   
                    
                });
                
        },
        remove: function (id) {
            let self = this;
            axios.delete('/api/students/' + id)
                .then(function (response) {
                    if (response.data['ok']) {
                        self.init();
                    }
                })
                .catch(function (response) {
                    console.log(response);
                });
        },
        cancel: function () {
            this.student = {id: null, name: '', birthday: '',description: ''};
            this.isSave = false;
        },
    
        //  modify: function (post) {
        //     location.href = "#form";
        //     this.student.id = "12";
        //     this.student.title ="改變";
        //     this.student.body = "嘿嘿";
        //     this.isSave = true;
        //     console.log(this.post);
        // },
        //  reverseMessage: function() {
             
        //     this.message = this.message.split('').reverse().join('');
        //     //this.message="123qweasd"
        //     console.log(this.message);
        //     //location.href = "\\test";
        // },
        // handleChange: function(){
        //     if(this.isOK)
        //         this.isOK=false;
        //     else
        //         this.isOK=true;
        // },
        // copyChange: function(){
        //     this.nowmessage=this.message;
        // },
        // handleToggleClick:function(){
        //     this.type=this.type==='name'?'mail':'name';
        // }
     },
     mounted: function () {
        this.init();
    }
     
      


    
}
</script>
