Vue.component('explore-topics', {
	data: function() {
		return {
			topics: []
		}
	},

	created: function() {
		this.fetchTopics();
	},

	methods: {
		fetchTopics: function() {
			var self = this;

			$.getJSON("/api/topics", function(data) {
				self.topics = data.results;
			})
		}
	},

	template: '#explore-topics-template'
});

Vue.component('trending-hashtags', {
	data: function() {
		return {
			hashtags: []
		}
	},

	created: function() {
		this.fetchHashtags();
	},

	methods: {
		fetchHashtags: function() {
			var self = this;

			$.getJSON("/api/hashtags/trending", function(data) {
				self.hashtags = data.results;
			})
		}
	},

	template: '#trending-hashtags-template'
});

var app = new Vue({
	el: '#hystio'
});