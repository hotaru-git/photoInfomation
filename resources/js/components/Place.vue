<template slot="items" slot-scope="props">

	<div id="app">
		<v-data-table
         :headers="headers"
         :items="photoInfo"
    	>
		<!-- 削除機能追加 -->
		<template v-slot:[`item.delete`]="{ item }">
			<v-btn
			small
			color="error"
			@click="deleteItem(item)"
			>
			delete
			</v-btn>
        </template>
		</v-data-table>
		<v-card>
			<v-card-title>
				<span class="headline">{{ formTitle }}</span>
			</v-card-title>
			<v-card-text>
				<!-- 登録項目の追加箇所 -->
				<!--  -->
				<v-container>
					<v-row>
						<v-col
							cols="12"
							sm="6"
							md="4"
							>
							<v-text-field
							v-model="editedItem.photo_id"
							label="写真ID"
							></v-text-field>
						</v-col>
						<v-col
							cols="12"
							sm="6"
							md="4"
							>
							<v-text-field
							v-model="editedItem.shooting_location"
							label="撮影場所"
							></v-text-field>
						</v-col>
						<!-- ToDo  セレクトボックスに変更予定-->
						<v-col
							cols="12"
							sm="6"
							md="4"
							>
							<v-text-field
							v-model="editedItem.prefecture"
							label="都道府県"
							></v-text-field>
						</v-col>
						<v-col
							cols="12"
							sm="6"
							md="4"
							>
							<v-text-field
							v-model="editedItem.iso"
							label="ISO感度"
							></v-text-field>
						</v-col>
						<v-col
							cols="12"
							sm="6"
							md="4"
							>
							<v-text-field
							v-model="editedItem.f_value"
							label="F値"
							></v-text-field>
						</v-col>
						<v-col
							cols="12"
							sm="6"
							md="4"
							>
							<v-text-field
							v-model="editedItem.shutter_speed"
							label="シャッター速度"
							></v-text-field>
						</v-col>
						<!-- 朝・昼・夕・夜のプルダウン -->
						<v-col
							cols="12"
							sm="6"
							md="4"
							>
							<v-text-field
							v-model="editedItem.time_zone"
							label="時間帯"
							></v-text-field>
						</v-col>
						<!-- フラグ０・１で管理 -->
						<v-col
							cols="12"
							sm="6"
							md="4"
							>
							<v-text-field
							v-model="editedItem.tripod_flag"
							label="三脚有無"
							></v-text-field>
						</v-col>
						<v-col
							cols="12"
							sm="6"
							md="4"
							>
							<v-text-field
							v-model="editedItem.other"
							label="備考"
							></v-text-field>
						</v-col>
					</v-row>
				</v-container>
				</v-card-text>

		<!-- 入力情報を登録する -->
				<v-card-actions>
				<v-spacer></v-spacer>
				<v-btn
				color="blue darken-1"
				text
				@click="close"
				>
				Cancel
				</v-btn>
				<v-btn
				color="blue darken-1"
				text
				@click="save"
				>
				Save
				</v-btn>
			</v-card-actions>
		</v-card>
	</div>
	
</template>

<script>
import axios from 'axios';

export default {
		data(){
			return{
				headers: [
					{ text: '写真ID', align: 'center', value: 'photo_id' },
					{ text: '撮影場所', align: 'center', value: 'shooting_location' },
					{ text: '都道府県', align: 'center', value: 'prefecture' },
					{ text: 'ISO感度', align: 'center', value: 'iso'},
					{ text: 'F値', align: 'center', value: 'f_value'},
					{ text: 'シャッター速度', align: 'center', value: 'shutter_speed'},
					{ text: '時間帯', align: 'center', value: 'time_zone'},
					{ text: '三脚有無', align: 'center', value: 'tripod_flag'},
					{ text: '備考', align: 'center', value: 'other'},
					// 削除行追加
					{
						text:'削除',
						value:'delete',
						sortable:false
					}
      			],
				photoInfo:[],

				editedIndex: -1,
				editedItem: {
					photo_id: 0,
					shooting_location: 0,
				},
				defaultItem: {
					photo_id: 0,
					shooting_location: 0,
				},
				// 追加しておくと項目がrequest payloadに追加される
				// photo_id: 0,
				// shooting_location: 0,
			}
		},
		computed: {
			formTitle () {
				return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
			},
		},
		mounted(){
			/* 
			  ①api/photoInfoでアクセスした際にjson形式でとれる
			  ②responseされた情報をphotoInfoに積める
			  ③api.phpでjsonデータを引っ張ってくる.
			*/
			//axios.get('/api/photoInfo')
			var self = this;
			var url = '/api/photoInfo/';
			axios.get(url)
				.then(response => {
					self.photoInfo = response.data.photoInfo;
					console.log(self.photoInfo);
				})
				.catch(error => {
					console.log(error)
				});
		},
		methods: {
			// イベントのメソッド追加箇所
			deleteItem (item) {
				const index = this.photoInfo.indexOf(item)
				confirm('ガチで削除しますか') && this.photoInfo.splice(index, 1)
			},
			editItem (item) {
				this.editedIndex = this.desserts.indexOf(item)
				this.editedItem = Object.assign({}, item)
				this.dialog = true
      		},
			  

		/*
		this is the method to register photo infamation when the infomation was input..
		*/
			save () {
				// if (this.editedIndex > -1) {
				// Object.assign(this.photoInfo[this.editedIndex], this.editedItem)
				// } else {
				
				// this.photoInfo.push(this.editedItem)
				// 項目をDBに追加
				var self = this;
				axios.post('/api/photoInfo/',self.editedItem)
                .then(response => {
					self.photo_id = response.editedItem.photo_id;
                    self.shooting_location = response.editedItem.shooting_location;
					
					console.log(response.editedItem.photo_id);
                })
                .catch(err => {
                    this.message = err;
                });
				}
				// this.close()
			},
			// close () {
			// 	this.dialog = false
			// 	this.$nextTick(() => {
			// 	this.editedItem = Object.assign({}, this.defaultItem)
			// 	this.editedIndex = -1
			// 	})
			// },
		}
// }
</script>