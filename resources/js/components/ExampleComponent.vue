<template>
     
    <div class="container">

        

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
        <button v-on:click="counter += 1">Add 1</button>
        <p>The button above has been clicked {{ counter }} times.</p>
        <input v-model="message" placeholder="edit me">
        <p>Message is: @{{ message }}</p>  --}}
    </div>
     
</template>
// <script src="{{ asset('js/app.js') }}" defer></script>
<script>
    export default {
        data() {
        return {
            posts: [],
            post: {
                id: null,
                title: '12',
                body: '3'
            },
            titleWarning: false,
            bodyWarning: false,
            isSave: false
        }
    },
    
}
    
</script>
