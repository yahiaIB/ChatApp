<template>

<section class="hero is-success is-fullheight">
  <div class="hero-body">
    <div class="container">
      <div class="card">
        <div class="card-content">

           <div class="msgs_container">
             <div class="msg" v-for='msg in conversation.messages'>{{ msg.msg }}</div>
           </div>

           <div class="columns">
             <div class="column">
               <div class="field">
                 <p class="control">
                   <textarea class="textarea" id="msg" placeholder="Normal textarea"></textarea>
                 </p>
               </div>
               </div>
               <div class="column">
                 <a class="button" @click='send()'>Send</a>
               </div>
               </div>

        </div>
      </div>
    </div>
  </div>
</section>

</template>

<script>
    export default {

      props : ['data'],

      data(){
         return {conversation : []}
      },

      methods:{

        send(){

          let msg = $('#msg').val();

          this.conversation.messages.push({
            'msg' : msg
          });

          this.$http.post('/send' , {msg : msg , conversation_id : this.conversation.id }).then(data => {
          $('#msg').val('');

          });
        }
      },

      mounted(){

        let data = JSON.parse(this.data);

        this.conversation = data;

                Echo.channel(`chat-${this.conversation.id}`)
                    .listen('MsgBroadcast', (e) => {
                        this.conversation.messages.push(e);
                    });

      }
    }
</script>

<style>

.msgs_container{
    height: 500px;
    background: whitesmoke;
    overflow:scroll;
}

.msg{
    padding: 30px;
    background: #2faefb;
}
</style>
