import React from "react";

export default class Body extends React.Component {
    constructor(props) {
        super(props);
        this.state = {count: 0};
    }

    componentDidMount() {
        try {
            const countData = localStorage.getItem('data');
            const data = ~~(JSON.parse(countData));
            if (!isNaN(data)) {
                this.setState(data)
            }

        } catch (e) {

        }
    }

    componentDidUpdate(prevProps, prevState, snapshot) {
        if (prevState.count !== this.state.count) {
            console.log("component did update a " + typeof this.state.count)
            const countData = JSON.stringify(this.state)
            localStorage.setItem('data', countData)

        }

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