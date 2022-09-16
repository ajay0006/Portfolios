import React from "react";

export default class AddOption extends React.Component {
    constructor(props) {
        super(props);
        this.onFormSubmit = this.onFormSubmit.bind(this)
        this.state = {
            error: undefined
        }
    }

    onFormSubmit(e) {
        e.preventDefault();
        let option = e.target.elements.option.value.trim();
        if (option) {
            option = option[0].toUpperCase() + option.substring(1)
        }
        const error = this.props.addOptions(option)

        this.setState({error})

        if (!error) {
            e.target.elements.option.value = '';
        }
    }

    render() {
        return (<div>
            {this.state.error && <p className='addOption-error'>{this.state.error}</p>}
            <form className='addOption-form' onSubmit={this.onFormSubmit}>
                <input className='addOption__input' type={'text'} name={'option'}/>
                <button className='button' id='addBtn'> Add Option</button>
            </form>
        </div>);
    }
}