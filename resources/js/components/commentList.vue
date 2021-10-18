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
    props: ['post', 'loginuserId'],
    data(){
        return{
            comments :[],
        }
    },

    components: {CommentItem},

    methods:{
        getComments(){
            this.comments=[
                '1st Comment', '2nd comment', '3rd comment', '4th comment'
            // 서버에 현재 게시글의 
            
            ]
        }
    }
}
</script>