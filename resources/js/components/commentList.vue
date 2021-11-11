<template>
    <div>

        <label class="block text-left" style="max-width: 400px">
            <span class="text-gray-700">댓글 작성</span>
            <textarea
                v-model="newComment"
                class="form-textarea mt-1 block w-full"
                rows="3"
                placeholder="Enter some content."></textarea>
            <button @click="addComment">등록</button>
        </label>

        <button class="btn btn-primary" @click="getComments">
            댓글 불러오기
        </button>

        <comment-item
            v-for="(comment, index) in comments.data"
            :key="index"
            :comment="comment"
            :login_user_id="loginuser"
            @deleted="getComments()"
            />

        <pagenation
            @pageClicked="getPage($event)"
            v-if="comments.data != null "
            :links="comments.links"/>
    </div>
</template>

<script>

    import CommentItem from "./CommentItem.vue";
    import Pagenation from './pagenation.vue';

    export default {
        props: [
            'post', 'loginuser'
        ],
        data() {
            return {comments: [], newComment: ''}
        },

        components: {
            CommentItem,
            Pagenation
        },

        methods: {

            getPage(url) {
                console.log(url);
                axios
                    .get(url)
                    .then(response => {
                        this.comments = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },

            getComments() {
                axios
                    .get('/comment/' + this.post.id)
                    .then(response => {
                        // console.log(response);
                        this.comments = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },

            addComment() {
                if (this.newComment == '') {
                    alert('내용을 적어주세요');
                    return;
                }

                axios
                    .post('/comment/' + this.post.id, {'comment': this.newComment})
                    .then(response => {
                        console.log(response.data);

                        this.getComments();
                        this.newComment = '';

                    })
                    .catch(error => {
                        console.log(error)
                    })

                }
        }
    }
</script>