import React, { useState } from 'react';
import PropTypes from 'prop-types';
import { Field } from 'redux-form';
import Radio from '@material-ui/core/Radio';
import RadioGroup from '@material-ui/core/RadioGroup';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import FormControl from '@material-ui/core/FormControl';
import FormLabel from '@material-ui/core/FormLabel';
import Typography from '@material-ui/core/Typography';

const RadioQuestion = ({ name, text, input, options, ...rest }) => {
    const [value, setValue] = useState('');

    const handleChange = event => {
        setValue(event.target.value);
    };

    return (
        <div>
            <Typography>{text}</Typography>
            <FormControl component="fieldset">
                <RadioGroup {...input} {...rest}>
                    {options.map((option, idx) => (
                        <FormControlLabel
                            key={idx}
                            name={name}
                            control={<Radio />}
                            label={option.text}
                            value={option.value.toString()}
                        />
                    ))}
                </RadioGroup>
            </FormControl>
        </div>
    );
};

export default RadioQuestion;
