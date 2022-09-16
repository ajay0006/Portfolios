import React from 'react';
import AddOption from './AddOption';
import Action from "./Action";
import Header from "./Header";
import Options from "./Options";
import OptionModal from "./OptionModal";
import Modal from "react-modal";
import 'normalize.css/normalize.css';
import '../styles/styles.scss';


class IndecisionApp extends React.Component {
    constructor(props) {
        super(props);
        this.addOptions = this.addOptions.bind(this);
        this.deleteOptions = this.deleteOptions.bind(this);
        this.handlePick = this.handlePick.bind(this);
        this.deleteOption = this.deleteOption.bind(this);
        this.state = {
            selectedOption: undefined,
            optionsIndecision_V2: []

        }
    }

    componentDidMount() {
        try {
            const objData = localStorage.getItem('data');
            const data = JSON.parse(objData);
            if (data) {
                this.setState(data)
            }

        } catch (e) {

        }

        Modal.setAppElement('body');
    }

    componentDidUpdate(prevProps, prevState, snapshot) {

        if (prevState.optionsIndecision_V2.length !== this.state.optionsIndecision_V2.length) {
            const jsonData = JSON.stringify(this.state)
            localStorage.setItem('data', jsonData)
        }

    }


    addOptions(value) {
        if (!value) {
            return 'Invalid Entry'
        } else if (this.state.optionsIndecision_V2.indexOf(value) > -1) {
            return 'Risk of duplicate data'
        }
        this.setState(prevState => ({
            optionsIndecision_V2: prevState.optionsIndecision_V2.concat(value)

        }))
    }


    deleteOption(optionToRemove) {
        this.setState(prevState => ({
            optionsIndecision_V2: prevState.optionsIndecision_V2.filter((option) => {
                return optionToRemove !== option
            })
        }))
    }

    deleteOptions() {
        this.setState({
            optionsIndecision_V2: []
        })
    }

    handlePick() {
        const randomNum = Math.floor(Math.random() * this.state.optionsIndecision_V2.length);
        const choice = this.state.optionsIndecision_V2[randomNum]
        this.setState({
            selectedOption: choice
        })
    }

    handleClearSelectedOption = () => {
        this.setState(() => ({selectedOption: undefined}))
    }

    render() {
        const indecision = {
            title: "Indecision", subtitle: "Let the computer make the choice for you"
        }
        return (
            <div>
                <Header /*title={indecision.title}*/ subtitle={indecision.subtitle}/>
                <div className='container'>
                    <Action data={this.state.optionsIndecision_V2.length > 0}
                            handlePick={this.handlePick}/>
                    <div className='widget-body'>
                        <Options
                            data={this.state}
                            removeAllOptions={this.deleteOptions}
                            removeOption={this.deleteOption}
                        />
                        <AddOption addOptions={this.addOptions}/>
                    </div>

                </div>

                <OptionModal
                    selectedOption={this.state.selectedOption}
                    handleClearSelectedOption={this.handleClearSelectedOption}
                />
            </div>)
    }
}


// for this to work it must come after the Header function is declared & it would have to be the same name
Header.defaultProps = {
    title: 'Indecision Application'
};

export default IndecisionApp;
