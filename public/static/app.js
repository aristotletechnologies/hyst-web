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

var app = new Vue({
	el: '#hystio'
});