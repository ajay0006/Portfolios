import Option from "./Option";
import React from "react";

const Options = (props) => (
    <div>

        <div className='widget-header'>
            <h3 className='widget-header__title'>
                Your Options
            </h3>
            <button className='button button--link' onClick={props.removeAllOptions}>Remove All</button>
        </div>
        {props.data.optionsIndecision_V2.length === 0 &&
            <p className='widget__text'>Please add an option to get started</p>}

        {//this.props.data.options.map((option) => <p key={this.props.data.options.indexOf(option)}>{option}</p>)
            props.data.optionsIndecision_V2.map((option, index) => (
                <Option
                    key={props.data.optionsIndecision_V2.indexOf(option)}
                    value={option}
                    count={index + 1}
                    removeSingleOption={props.removeOption}
                />))
            // I chose to use the index position of the value as the key
        }
    </div>
);

export default Options