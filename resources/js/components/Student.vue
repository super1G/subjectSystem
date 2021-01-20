<template>
    <div class="content">
        <h1>123</h1>
        
        <h1>{{ student.title }}</h1>
        <p>{{ student.body }}</p>
        <button class="btn btn-xs btn-primary" @click="modify(post)">修改</button>
        <button class="btn btn-xs btn-danger" @click="remove(post.id)">刪除</button>
        <hr>
        
        
        {{isOK?'NO':'YES'}}
        
        <h1>Trying out Vue.js</h1>
        <p>{{ message }}</p>
        <button @click="reverseMessage()">Reverse Message</button>
    </div>
    

</template>

<script>
export default {
    data() {
        
        
        return {
            posts: [],
            student: {
                id: null,
                title: '12',
                body: '334'
            },
            number:100,
            isOK:false,
            texts:'123,456',
            message: "Laura is awesome!"
            
        }
        
    },
     methods: {
         modify: function (post) {
            location.href = "#form";
            this.student.id = "12";
            this.student.title ="改變";
            this.student.body = "嘿嘿";
            this.isSave = true;
            console.log(this.post);
        },
         reverseMessage: function() {
             
            this.message = this.message.split('').reverse().join('');
            //this.message="123qweasd"
            console.log(this.message);
            //location.href = "\\test";
        }
     }
     
      


    
}
</script>
