<template slot="items" slot-scope="props">
	<div id="app">
		<v-data-table :headers="headers" :items="mountainList" dense class="elevation-1">
			<template>
				<tbody class="custom-body">
					<tr v-for="mountainList in mountainList" :key="mountainList.id" class="custom-tr">
					<td>{{ mountainList.id }}</td>
					<td>{{ mountainList.name }}</td>
					<td>{{ mountainList.nameKana }}</td>
					<td>{{ mountainList.elevation }}m</td>
					<td v-if="!mountainList.prefectures[1]">{{ mountainList.prefectures[0] }}</td>
					<td v-else>{{ mountainList.prefectures[0] }}/{{mountainList.prefectures[1]}}</td>
					<td>{{ mountainList.area }}</td>
					</tr>
				</tbody>
			</template>
		</v-data-table>
		<div>
			<v-text-field
				v-model.trim="searchKeyword"
				@change="search()"
				label="検索テキスト"
			>
			</v-text-field>
		</div>
		<table>
			<thead>
				<tr>
					<td>id</td>
					<td>name</td>
					<td>nameKana</td>
					<td>elevation</td>
					<td>prefectures</td>
					<td>area</td>
				</tr>
			</thead>
			<tbody>
				<tr
				v-for="(item, i) in searchItems"
				:key="i"
				>
					<td>{{ item.id }}</td>
					<td>{{ item.name }}</td>
					<td>{{ item.nameKana }}</td>
					<td>{{ item.elevation }}</td>
					<td>{{ item.prefectures }}</td>
					<td>{{ item.area }}</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
import axios from 'axios';

export default {
		data(){
			return{
				mountainList:[],
				headers: [
					{ text: 'ID', align: 'center', value: 'id' },
					{ text: '山脈名', align: 'center', value: 'name' },
					{ text: '山脈名(カナ)', align: 'center', value: 'nameKana' },
					{ text: '標高', align: 'center', value: 'elevation' },
					{ text: '県', align: 'center', value: 'prefectures' },
					{ text: '地域', align: 'center', value: 'area' },
					{ text: '行った', align: 'center', value: 'visited' },
				],
				
				searchKeyword: "", // 追加
				searchItems: [],
			}
		},
		/*
		computed
			算出プロパティー
		*/
		computed: {

		},
		created(){
			/* 
			日本100名山の一覧を取得する
			*/
			var url = 'https://mountix.codemountains.org/api/v1/mountains?tag=1';
			axios.get(url)
				.then(response => {
					this.mountainList = response.data.mountains;
					console.log(this.mountainList);
				})
				.catch(error => {
					console.log(error)
				});
		},
		methods: {
			search () {
				let items = this.mountainList
				self = this;
				let fullItems = [];
				if(self.searchKeyword) {
					// 検索ワードと各項目の内容を比較して、検索ワードに引っかかった行を配列に追加
					let firstItems = items.filter((v) =>
						v.area.includes(self.searchKeyword) ||
						v.name.includes(self.searchKeyword) ||
						v.nameKana.includes(self.searchKeyword) ||
						v.prefectures[0].includes(self.searchKeyword)
					)
					fullItems.push(firstItems);
					// 県名が配列で持っている関係で、別の配列として取得
					let secondItems = items.filter((v) =>
						v.prefectures[1] ? v.prefectures[1].includes(self.searchKeyword) : v.prefectures[0].includes(self.searchKeyword)
					)
					fullItems.push(secondItems);
				}
				// ＩＤが重複している行は削除する
				this.searchItems = fullItems[0].concat(fullItems[1]).filter(
				(item, index, array) => {
					return (
					array.findIndex(nextItem => item.id === nextItem.id) ===
					index
					);
				}
				);
			},
			/**
			 * downloadCSV CSVエクスポート
			 */
			downloadCSV () {
				var csv = '\ufeff' + '写真ID,撮影場所,都道府県,ISO,F値,シャッター時間,時間帯,三脚有無,備考\n'
				this.photoInfo.forEach(el => {
					var line = el['photo_id'] + ',' + el['shooting_location'] + ',' + el['prefecture'] +',' + el['iso'] +',' + el['f_value'] +',' + el['shutter_speed'] +',' + el['time_zone'] +',' + el['is_tripod'] +',' + el['other'] +'\n'
					csv += line
				})
				let blob = new Blob([csv], { type: 'text/csv' })
				let link = document.createElement('a')
				link.href = window.URL.createObjectURL(blob)
				link.download = 'Result.csv'
				link.click()
			}
		}
}
</script>