class IndecisionApp extends React.Component {
    constructor(props) {
        super(props);
        this.addOptions = this.addOptions.bind(this);
        this.deleteOptions = this.deleteOptions.bind(this);
        this.handlePick = this.handlePick.bind(this);
        this.state = {
            indecisionData:
                {
                    title: "Indecision",
                    subtitle: "Let the computer make the choice for you",
                    optionsIndecision: [],
                }
        };
    }

    addOptions(value) {
        if (!value) {
            return 'Invalid Entry'
        } else if (this.state.indecisionData.optionsIndecision.indexOf(value) > -1) {
            return 'Risk of duplicate data'
        }
        this.setState(prevState => (
                {
                    indecisionData:
                        {
                            optionsIndecision: prevState.indecisionData.optionsIndecision.concat(value)
                        }
                }
            )
        )
    }

    deleteOptions() {
        this.setState({
            indecisionData: {optionsIndecision: []}
        })
    }

    handlePick() {
        const randomNum = Math.floor(Math.random() * this.state.indecisionData.optionsIndecision.length);
        const choice = this.state.indecisionData.optionsIndecision[randomNum]
        alert(choice);
    }

    render() {
        const indecision =
            {
                title: "Indecision",
                subtitle: "Let the computer make the choice for you"
            }
        return (
            <div>
                <Header /*title={indecision.title}*/ subtitle={indecision.subtitle}/>
                <Action data={this.state.indecisionData.optionsIndecision.length > 0} handlePick={this.handlePick}/>
                <Options data={this.state.indecisionData} removeAllOptions={this.deleteOptions}/>
                <AddOption addOptions={this.addOptions}/>
            </div>
        )
    }
}


const Header = (props) => {
    return (
        <div>
            <h1>{props.title}</h1>
            {/*does the subtitle have a value, if true then do next*/}
            {props.subtitle && <h2>{props.subtitle}</h2>
            }
        </div>
    );
};

// for this to work it must come after the Header function is declared & it would have to be the same name
Header.defaultProps = {
    title: 'Indecision Default'
};

const Action = (props) => {
    return (
        <div>
            <button disabled={!props.data} onClick={props.handlePick}>What should i do</button>
        </div>
    );
}

const Options = (props) => {
    return (
        <div>
            {
                //this.props.data.options.map((option) => <p key={this.props.data.options.indexOf(option)}>{option}</p>)
                props.data.optionsIndecision.map((option) => <Option
                    key={props.data.optionsIndecision.indexOf(option)} value={option}/>)
                // i chose to use the index position of the value as the key
            }
            <div>
                <button onClick={props.removeAllOptions}>Remove All</button>
            </div>
        </div>
    );
}

const Option = (props) => {
    return (
        <div> {props.value}</div>
    );
}

class AddOption extends React.Component {
    constructor(props) {
        super(props);
        this.onFormSubmit = this.onFormSubmit.bind(this)
        this.state = {
            error: undefined
        }
    }

    onFormSubmit(e) {
        e.preventDefault();
        const option = e.target.elements.option.value.trim();
        const error = this.props.addOptions(option)

        this.setState({error})
    }

    render() {
        return (
            <div>
                {this.state.error && <p>{this.state.error}</p>}
                <form onSubmit={this.onFormSubmit}>
                    <input type={'text'} name={'option'}/>
                    <button id='addBtn'> Add Option</button>
                </form>
            </div>
        );
    }
}

export default IndecisionApp;
