import React, { useState } from 'react';
import PropTypes from 'prop-types';
import { Field, FieldArray } from 'redux-form';
import CardHeader from '@material-ui/core/CardHeader';
import CardContent from '@material-ui/core/CardContent';
import Checkbox from '@material-ui/core/Checkbox';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import FormControl from '@material-ui/core/FormControl';
import FormGroup from '@material-ui/core/FormGroup';
import Typography from '@material-ui/core/Typography';

const CheckboxQuestion = ({ name, text, input, options, saveFn, ...rest }) => (
    <>
        <CardHeader title={text} />
        <CardContent>
            <FormControl component="fieldset">
                <FormGroup {...rest} onBlur={saveFn}>
                    {options.map((option, idx) => (
                        <div key={idx}>
                            <FormControlLabel
                                control={<Checkbox color="primary" />}
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
                                            newValue.indexOf(option.value),
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
        </CardContent>
    </>
);

export default CheckboxQuestion;
