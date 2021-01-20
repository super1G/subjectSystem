<template v-if="type==='name'">
    <div class="album py-5 bg-light">
        
        
        <div class="container">
            <div class="row justify-content-start">
                    <div class="col-4">
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
                    <div class="col-4">
                        <h1>{{ student.name }}</h1>
                    </div>
                    <div class="col-3">
                        <h2>{{ student.birthday }}</h2>
                    </div>
                    <div class="col-3">
                        <p>{{ student.description}}</p>
                    </div>
                    
                    <button class="btn btn-xs btn-primary" @click="modify(post)">修改</button>
                    <button class="btn btn-xs btn-danger" @click="remove(post.id)">刪除</button>
                    <hr>
                </div>
            
            </div>
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
        }
    
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
