import React, { useState } from 'react';
import PropTypes from 'prop-types';
import { Field, FieldArray } from 'redux-form';
import Checkbox from '@material-ui/core/Checkbox';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import FormControl from '@material-ui/core/FormControl';
import FormLabel from '@material-ui/core/FormLabel';
import FormGroup from '@material-ui/core/FormGroup';
import FormHelperText from '@material-ui/core/FormHelperText';
import Typography from '@material-ui/core/Typography';
import CheckboxGroup from './CheckboxGroup';

const CheckboxQuestion = ({ name, text, input, options, saveFn, ...rest }) => {
    /*const [value, setValue] = useState({});

    const handleChange = event => {
        setValue({ ...value, [event.target.value]: event.target.checked });
    };

    const renderOptions = ({ fields }) => {
        options.forEach(option => fields.push(option));

        return fields.map((option, idx) => (
            <Field
                key={idx}
                name={`${name}.${option.value}`}
                component={FormControlLabel}
                control={<Checkbox />}
                label={option.text}
                value={option.value}
            />
        ));
    };*/

    return (
        <div>
            <Typography>{text}</Typography>
            <FormControl component="fieldset">
                <FormGroup {...rest} onBlur={saveFn}>
                    {options.map((option, idx) => (
                        <div key={idx}>
                            <FormControlLabel
                                control={<Checkbox />}
                                label={option.text}
                                name={`${name}[${option.value}]`}
                                value={option.value}
                                checked={
                                    input.value.indexOf(option.value) !== -1
                                }
                                onChange={event => {
                                    const newValue = [...input.value];
                                    if (event.target.checked) {
                                        newValue.push(option.value);
                                    } else {
                                        newValue.splice(
                                            newValue.indexOf(option.text),
                                            1
                                        );
                                    }

                                    return input.onChange(newValue);
                                }}
                            />
                        </div>
                    ))}
                </FormGroup>
            </FormControl>
            {/*<CheckboxGroup name={name} options={options} input={input} />*/}
        </div>
    );
};

export default CheckboxQuestion;
