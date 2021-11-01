<template>
    <div>
        <button class="btn btn-primary" @click="getComments">
            댓글 불러오기
        </button>

        <comment-item v-for="(comment, index) in comments" :key="index" :comment="comment"/>
    </div>
</template>


<script>

import CommentItem from "./CommentItem.vue";

export default {
    props: ['post', 'loginuser'],
    data(){
        return{
            comments :[],
        }
    },

    components: {CommentItem},

    methods:{
        getComments(){
            axios.get('/comment/'+this.post.id).then(response=>{
                // console.log(response);
                this.comments = response.data;
            }).catch(error=>{
                console.log(error);
            });
        }
    }
}
</script>