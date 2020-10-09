import React, { useState } from 'react';
import PropTypes from 'prop-types';
import Radio from '@material-ui/core/Radio';
import RadioGroup from '@material-ui/core/RadioGroup';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import FormControl from '@material-ui/core/FormControl';
import FormLabel from '@material-ui/core/FormLabel';
import Typography from '@material-ui/core/Typography';

const RadioQuestion = ({ question }) => {
    const [value, setValue] = useState(-1);

    const handleChange = event => {
        setValue(event.target.value);
    };

    return (
        <>
            <Typography>{question.text}</Typography>
            <FormControl component="fieldset">
                <RadioGroup name="ime" value={value} onChange={handleChange}>
                    {question.optiongroup.options.map((option, idx) => (
                        <FormControlLabel
                            key={idx}
                            control={<Radio />}
                            label={option.text}
                            value={option.value}
                        />
                    ))}
                </RadioGroup>
            </FormControl>
        </>
    );
};

export default RadioQuestion;
