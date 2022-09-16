class Counter extends React.Component {
    render() {
        return (
            <div>
                <Header/>
                <Body/>
                <Footer/>
            </div>
        );
    }
}

class Header extends React.Component {
    render() {
        return (
            <div>
            </div>
        );
    }
}

class Body extends React.Component {
    constructor(props) {
        super(props);
        this.state = {count: 0};
    }

    increment = () => {
        this.setState(prevState => ({count: prevState.count + 1}))
    }
    decrement = () => {
        this.setState(prevState => ({count: prevState.count - 1}))
    }
    reset = () => {
        this.setState({count: 0})
    }

    render() {
        return (
            <div>
                <h1>Count:{this.state.count} </h1>
                <button onClick={this.increment}>+1</button>
                <button onClick={this.decrement}>-1</button>
                <button onClick={this.reset}>reset</button>
            </div>
        );
    }
}

class Footer extends React.Component {
    render() {
        return (
            <div>
            </div>
        );
    }

}

export default Counter;