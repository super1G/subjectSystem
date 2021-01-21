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
            <div v-for="(teacher) in teachers.data" v-bind:key="teacher.id">
               
                <div class="row justify-content-start">
                    <div class="col-1">
                        <h1>{{ teacher.id }}</h1>
                    </div>
                    <div class="col-2">
                        <h1>{{ teacher.name }}</h1>
                    </div>
                    <div class="col-3">
                        <h2>{{ teacher.birthday }}</h2>
                    </div>
                    <div class="col-3">
                        <p>{{ teacher.description}}</p>
                    </div>
                    
                    <button class="btn btn-xs btn-primary" @click="modify(teacher)">修改</button>
                    <button class="btn btn-xs btn-danger" @click="remove(teacher.id)">刪除</button>
                    <hr>
                </div>
            
            </div>

            <form>
                <div class="mb-3">
                    <label for="inputName" class="form-label">名字</label>
                    <input v-model="teacher.name" type="text" class="form-control" id="inputName" aria-describedby="nameHelp">
                    <div id="nameHelp" class="form-text">輸入名字</div>
                </div>
                <div class="mb-3">
                    <label for="InputDate" class="form-label">生日</label>
                    <input v-model="teacher.birthday" type="date" class="form-control" id="InputDate" aria-describedby="DateHelp">
                    <div id="DateHelp" class="form-text">非必填</div>
                </div>
                <div class="mb-3">
                    <label for="InputDescription" class="form-label">備註</label>
                    <input v-model="teacher.description" type="text" class="form-control" id="InputDescription" aria-describedby="DescriptionHelp">
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
        

        
         
        

    </div>
    

</template>


   
<script>
export default {
    
    data() {
        
        
        return {
            isSave: false,
            teachers: [],
            teacher: {
                id:null,
                name: '',
                birthday: '',
                description: ''
                
            }
            
        }
        
    },
     methods: {
         init: function () {
            let self = this;
            axios.get('/api/teachers')
                .then(function (response) {
                    self.teachers  = response.data;
                   
                    console.log(" self.teachers");
                    console.log( self.teachers);
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
            axios.post('/api/teachers', this.teacher)
                .then(function (response) {
                    if (response.data['ok']) {
                        self.init();
                        
                        this.teacher = {id: null, name: '', birthday: '',description: ''};
                    }
                })
                .catch(function (response) {
                    console.log(response)
                });
        },

        modify: function (teacher) {
            location.href = "#form";
            this.teacher.id = teacher.id;
            this.teacher.name = teacher.name;
            this.teacher.birthday = teacher.birthday;
            this.teacher.description = teacher.description;
            this.isSave = true;
            console.log(this.teacher);
        }, 
         save: function () {
             
            let self = this;
            axios.patch('/api/teachers/'+this.teacher.id ,{name:this.teacher.name, birthday:this.teacher.birthday,description:this.teacher.description} )
                .then(function (response) {
                    if (response.data['ok']) {
                        self.init();
                        self.isSave = false;
                        this.teacher = {id: null, name: '', birthday: '',description: ''};
                    }
                    console.log(response);
                })
                .catch(function (response) {
                    console.log(response);
                   
                    
                });
                
        },
        remove: function (id) {
            let self = this;
            axios.delete('/api/teachers/' + id)
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
            this.teacher = {id: null, name: '', birthday: '',description: ''};
            this.isSave = false;
        },
    
        //  modify: function (post) {
        //     location.href = "#form";
        //     this.teacher.id = "12";
        //     this.teacher.title ="改變";
        //     this.teacher.body = "嘿嘿";
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
