var Author = React.createClass({
  getInitialState: function() {
    return {data: [], error: null, isLoaded: false};
  },
  //new start
  componentDidMount: function() {
    $.ajax({
      url: this.props.url,
      dataType: 'json',
      cache: false,
      success: function(data) {
        this.setState({data: data, isLoaded: true});
      }.bind(this),
      error: function(xhr, status, err) {
        console.error(this.props.url, status, err.toString());
      }.bind(this)
    });
  },
  //new end
  render: function() {
    const { error, isLoaded, data } = this.state;
    data.sort(function(a,b){
        var nA = a.name.toLowerCase();
        var nB = b.name.toLowerCase();

        if(nA < nB)
          return -1;
        else if(nA > nB)
          return 1;
       return 0;
    })
    console.log(data);
     if (error) {
      return <div>Ошибка: {error.message}</div>;
    } else if (!isLoaded) {
      return <h4>Загрузка...</h4>;
    } else {
      return (
        <ul>
          {data.map(
                  (item,i) => (
            <div key={i}>
              <h4>{item.name}</h4> Кол. книг на сайте: {item.book_count}<hr/>
            </div>
          ))}
        </ul>
      );
    }
  }
});

ReactDOM.render(
  <Author url="http://62ce86b7.ngrok.io/site/book" pollInterval={2000} />, // new
  document.getElementById('content')
);