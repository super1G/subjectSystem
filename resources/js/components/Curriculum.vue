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
                        <h2>老師</h2>
                    </div>
                    <div class="col-3">
                        <p>助教</p>
                    </div>
                    
                    <hr>
                </div>
            <div v-for="(curriculum) in curriculums.data" v-bind:key="curriculum.id">
               <!-- {{curriculum}} -->
                <div class="row justify-content-start">
                    <div class="col-1">
                        <h1>{{ curriculum.id }}</h1>
                    </div>
                    <div class="col-2">
                        <h1>{{ curriculum.name }}</h1>
                    </div>
                    <div class="col-3">
                        <h2>{{ curriculum.teacher.name }}</h2>
                    </div>
                    <div class="col-3">
                        <p>{{ curriculum.teaching_assistant}}</p>
                    </div>
                    
                    <button class="btn btn-xs btn-primary" @click="modify(curriculum)">修改</button>
                    <button class="btn btn-xs btn-danger" @click="remove(curriculum.id)">刪除</button>
                    <hr>
                    
                </div>
                
            </div>

            <form>
                <div class="mb-3">
                    <label for="inputName" class="form-label">課程名字</label>
                    <input v-model="curriculum.name" type="text" class="form-control" id="inputName" aria-describedby="nameHelp">
                    <div id="nameHelp" class="form-text">輸入名字</div>
                </div>
                <div class="mb-3">
                    <label for="InputDate" class="form-label">老師ID</label>
                    <input v-model="curriculum.teacher_id" type="number" class="form-control" id="InputDate" aria-describedby="DateHelp">
                    <div id="DateHelp" class="form-text">必填</div>
                </div>
                <div class="mb-3">
                    <label for="InputDescription" class="form-label">助教</label>
                    <input v-model="curriculum.teaching_assistant" type="text" class="form-control" id="InputDescription" aria-describedby="DescriptionHelp">
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
            curriculums: [],
            curriculum: {
                id:null,
                name: '',
                teacher_id: '',
                teaching_assistant: ''
                
            }
            
        }
        
    },
     methods: {
         init: function () {
            let self = this;
            axios.get('/api/curriculums')
                .then(function (response) {
                    self.curriculums  = response.data;
                   
                    console.log(" self.curriculums");
                    console.log( self.curriculums);
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
            axios.post('/api/curriculums', this.curriculum)
                .then(function (response) {
                    if (response.data['ok']) {
                        self.init();
                        
                        this.curriculum = {id: null, name: '', teacher_id: '',teaching_assistant: ''};
                    }
                })
                .catch(function (response) {
                    console.log(response)
                });
        },

        modify: function (curriculum) {
            location.href = "#form";
            this.curriculum.id = curriculum.id;
            this.curriculum.name = curriculum.name;
            this.curriculum.teacher_id = curriculum.teacher_id;
            this.curriculum.teaching_assistant = curriculum.teaching_assistant;
            this.isSave = true;
            console.log(this.curriculum);
        }, 
         save: function () {
             
            let self = this;
            axios.patch('/api/curriculums/'+this.curriculum.id ,{name:this.curriculum.name, teacher_id:this.curriculum.teacher_id,teaching_assistant:this.curriculum.teaching_assistant} )
                .then(function (response) {
                    if (response.data['ok']) {
                        self.init();
                        self.isSave = false;
                        this.curriculum = {id: null, name: '', teacher_id: '',teaching_assistant: ''};
                    }
                    console.log(response);
                })
                .catch(function (response) {
                    console.log(response);
                   
                    
                });
                
        },
        remove: function (id) {
            let self = this;
            axios.delete('/api/curriculums/' + id)
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
            this.curriculum = {id: null, name: '', teacher_id: '',teaching_assistant: ''};
            this.isSave = false;
        },
    
        
     },
     mounted: function () {
        this.init();
    }
     
      


    
}
</script>
