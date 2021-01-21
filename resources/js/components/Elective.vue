<template>
    <div class="album py-5 bg-light">
        
        
        <div class="container">
            <div class="row justify-content-start">
                    <div class="col-1">
                        <h1>ID</h1>
                    </div>
                    <div class="col-3">
                        <h1>學生名字</h1>
                    </div>
                    <div class="col-3">
                        <h2>課程名稱</h2>
                    </div>
                    <div class="col-3">
                        <h2>老師名稱</h2>
                    </div>
                    
                    <hr>
                </div>
            <div v-for="(elective) in electives.data" v-bind:key="elective.id">
                <!-- {{elective}}  -->
                <div class="row justify-content-start">
                    <div class="col-1">
                        <h1>{{ elective.id }}</h1>
                    </div>
                    <div class="col-3">
                        <h1>{{ elective.student.name }}</h1>
                    </div>
                    <div class="col-3">
                        <h2>{{ elective.curriculum.name }}</h2>
                    </div>
                    
                    
                    
                    <button class="btn btn-xs btn-primary" @click="modify(elective)">修改</button>
                    <button class="btn btn-xs btn-danger" @click="remove(elective.id)">刪除</button>
                    <hr>
                    
                </div>
                
            </div>

            <form>
                <div class="mb-3">
                    <label for="inputstudent_id" class="form-label">學生ID</label>
                    <input v-model="elective.student_id" type="number" class="form-control" id="inputstudent_id" aria-describedby="student_idHelp">
                    <div id="student_idHelp" class="form-text">輸入名字</div>
                </div>
                <div class="mb-3">
                    <label for="InputDate" class="form-label">課程ID</label>
                    <input v-model="elective.curriculum_id" type="number" class="form-control" id="InputDate" aria-describedby="DateHelp">
                    <div id="DateHelp" class="form-text">必填</div>
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
            electives: [],
            elective: {
                id:null,
                student_id: '',
                curriculum_id: '',
                
                
            }
            
        }
        
    },
     methods: {
         init: function () {
            let self = this;
            axios.get('/api/electives')
                .then(function (response) {
                    self.electives  = response.data;
                   
                    console.log(" self.electives");
                    console.log( self.electives);
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
            axios.post('/api/electives', this.elective)
                .then(function (response) {
                    if (response.data['ok']) {
                        self.init();
                        
                        this.elective = {id: null, student_id: '', curriculum_id: ''};
                    }
                })
                .catch(function (response) {
                    console.log(response)
                });
        },

        modify: function (elective) {
            location.href = "#form";
            this.elective.id = elective.id;
            this.elective.student_id = elective.student_id;
            this.elective.curriculum_id = elective.curriculum_id;
            
            this.isSave = true;
            console.log(this.elective);
        }, 
         save: function () {
             
            let self = this;
            axios.patch('/api/electives/'+this.elective.id ,{student_id:this.elective.student_id, curriculum_id:this.elective.curriculum_id} )
                .then(function (response) {
                    if (response.data['ok']) {
                        self.init();
                        self.isSave = false;
                        this.elective = {id: null, student_id: '', curriculum_id: ''};
                    }
                    console.log(response);
                })
                .catch(function (response) {
                    console.log(response);
                   
                    
                });
                
        },
        remove: function (id) {
            let self = this;
            axios.delete('/api/electives/' + id)
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
            this.elective = {id: null, student_id: '', curriculum_id: ''};
            this.isSave = false;
        },
    
        
     },
     mounted: function () {
        this.init();
    }
     
      


    
}
</script>
