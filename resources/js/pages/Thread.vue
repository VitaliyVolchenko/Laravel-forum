<script>    
    import Replies from '../components/Replies.vue';

    export default {
        props: ['initialRepliesCount'],

        component: { Replies },

        data() {
            return {
                repliesCount: this.initialRepliesCount
            };
        }
    }
</script>