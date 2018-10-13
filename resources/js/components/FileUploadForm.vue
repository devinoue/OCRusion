<template>
    <v-app>

   <v-alert
      :value="success_flg"
      type="success"
      dismissible
      transition="scale-transition"
    >

      {{res_message}}
    </v-alert>
    <v-alert
      :value="error_flg"
      type="error"
      dismissible
      transition="scale-transition"
    >

      {{res_message_error}}
    </v-alert>
<div 
        :class="['dropzone-area', dragging ? 'dropzone-over' : '']" 
        drag-over="handleDragOver" 
        @dragenter="dragging=true" 
        @dragleave="dragging=false">
   <div class="dropzone-text">
              <span class="dropzone-title">ここに画像を圧縮したZIPファイルをドラッグ・アンド・ドロップしてください。<br>
              <b>ファイル名は、必ず半角英数字に変更しておいてください。</b><br>
              </span>
              <span v-if="file">アップロードするファイル : {{file.name}}</span>
          </div>

                <input id="upform" type="file" multiple="multiple" @change="onDrop" >


    </div>

   
    <v-checkbox
      v-model="checkbox"
      :rules="[v => !!v || '必ず免責事項をお読みになってください']"
      label=" 注意事項を了承する"
      required
    ></v-checkbox>

      <v-btn
        color="blue-grey"
        class="white--text"
        :disabled="!checkbox"
        :loading="dialog"
        @click.stop="dialog = true"
        large 
      >
        アップロードする
        <v-icon right dark>cloud_upload</v-icon>
      </v-btn>

      <div>
      <b>注意事項</b>
<ul class="browser-default">
    <li>一度にアップロードできるZIPファイルは30MBまでです。</li>
    <li><b>1ファイル300KB以下</b>が理想的です。それ以上のファイルがあると不正終了になりやすいです。</li>
    <li>アップロードするファイルは、半角英数字のファイル名に変えてください</li>
    <li>ルビが多い本、段組の本はうまくテキスト化できません。</li>
    <li>違法に入手したファイルをアップロードしないでください。</li>
    <li>アップロードしたファイルは一週間で削除されます。ご了承ください。</li>
    <li>OCRデータは永続的に保存されるわけではありません。<br>可能な限りデータはご自身のローカル環境に保存しなおしてください。</li>
    <li>OCR出力されたデータは、<b>日本の法令に基づいて適切にご利用ください。</b></li>
    <li>本サービスを利用したことによる損害は、一切の責任を負いかねますのでご了承ください。</li>
    <li>その他、<a href="http://ocrusion.my-portfolio.site/privacy">プライバシーポリシー</a>についても御覧ください。</li>
</ul>
</div>

    <v-dialog
        v-model="dialog"
        hide-overlay
        persistent
        width="300"
      >
        <v-card
          color="primary"
          dark
        >
          <v-card-text>
            処理に時間がかかります。しばらくお待ち下さい。
            <v-progress-linear
              indeterminate
              color="white"
              class="mb-0"
            ></v-progress-linear>
          </v-card-text>
        </v-card>
    </v-dialog>

    </v-app>

</template>


<script>


    export default {


        props : ['token','user_id'],
        data :()=> ({
            loading:false,
            file:null,
            success_flg:false,
            res_message:'',
            res_message_error:'',
            dialog:false,
            checkbox: false,
            dragging: false,
            error_flg : false,
        }),
        watch: {
            dialog (val) {
            if (!val) return
                if (document.getElementById("upform").value == "") {
                    alert('ファイルが選択されていません');
                    this.dialog = false;
                    return;
                }

                let data = new FormData;

                const self=this;

                data.append('upfile', this.file);
                data.append('_token', this.token);
                data.append('user_id', this.user_id);

                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                };

                // ホスト先の振り分け
                let host;
                if (location.hostname == 'localhost'){
                    host = 'http://localhost/rest/public/api/register_dir';
                } else {
                    host = 'https://ocrusion.my-portfolio.site/api/register_dir';
                }

                axios.post(host,data,config)
                .then((response) => {
                    console.log(response.data);
                    if (response.data.error) {
                        self.res_message_error = response.data.error;
                        self.error_flg = true;
                    } else {
                      self.res_message = response.data.message;
                      self.success_flg = true;
                    }
                    self.loading = false;
                    self.dialog = false,

                    document.getElementById("upform").value = "";
                })
                .catch((error) => {
                    console.log(error);
                    self.res_message_error = error;
                    self.error_flg = true;
                    self.loading = false;
                    self.dialog = false

                    document.getElementById("upform").value = "";

                })

            },
        },
        methods : {
            //ファイル選択で選んだファイルを取得する  
            onDrop:function(event){
                this.file = event.target.files[0] ? 
                            event.target.files[0] :
                            event.dataTransfer.files[0];

            }    
        }
    }
</script>


<style scoped lang="scss">
/* refference : https://jsfiddle.net/panamaprophet/0L2433gu/ */
.drop {
    width: 80%;
    height: 200px;
    position: relative;
    border: 2px dashed #CBCBCB;
}

.drop:hover{
    border: 2px dashed #2E94C4;
}

.drop input {
    position: absolute;
    cursor: pointer;
    top: 0px;
    right: 0;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
}
li{
    list-style-type: circle;
}
.dropzone-over {
  
  border: 1px solid red !important;
}
.dropzone-area {
    width: 80%;
    height: 200px;
    position: relative;
    border: 2px dashed #CBCBCB;
    &:hover {
        border: 2px dashed #2E94C4;
        .dropzone-title {
          color: #1975A0;
        }

    }
}

.dropzone-area input {
    position: absolute;
    cursor: pointer;
    top: 0px;
    right: 0;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
}

.dropzone-text {
    position: absolute;
    top: 50%;
    text-align: center;
    transform: translate(0, -50%);
    width: 100%;
    span {
        line-height: 1.9;
    }
}

.dropzone-title {
    font-size: 16px;
    color: #787878;
    letter-spacing: 0.4px;
}

/* vuetifyのcss定義を初期化する */
.container{
    flex: initial;
    margin: initial;
    padding: initial;
    width: initial;
}
</style>