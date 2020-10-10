import React from 'react';
import PropTypes from 'prop-types';
import { withStyles } from '@material-ui/core';
import { Field } from 'redux-form';
import Card from '@material-ui/core/Card';
import TextQuestion from './TextQuestion';
import RadioQuestion from './RadioQuestion';
import CheckboxQuestion from './CheckboxQuestion';

const Question = ({ question, classes }) => {
    const renderQuestion = (question) => {
        switch (question.type) {
            case 0:
            case 1:
                return (
                    <Field
                        key={question.id}
                        component={TextQuestion}
                        name={question.code}
                        text={question.text}
                        questionType={question.type}
                    />
                );
            case 2:
                return (
                    /*<Field
                        key={question.id}
                        component={RadioQuestion}
                        name={question.code}
                        text={question.text}
                        options={question.optiongroup.options}
                    />*/
                    <Field
                        key={question.id}
                        component={RadioQuestion}
                        name={question.code}
                        text={question.text}
                        options={question.optiongroup.options}
                    />
                );
            case 3:
                return (
                    <Field
                        key={question.id}
                        component={CheckboxQuestion}
                        name={question.code}
                        text={question.text}
                        options={question.optiongroup.options}
                    />
                );
            case 4:
                return null;
            case 5:
                return null;
            case 6:
                return null;
            default:
                return null;
        }
    };

    return <Card className={classes.root}>{renderQuestion(question)}</Card>;
};

Question.propTypes = {
    question: PropTypes.object.isRequired,
};

const styles = (theme) => ({
    root: {
        margin: theme.spacing(3),
        padding: theme.spacing(1),
    },
});

export default withStyles(styles, { withTheme: true })(Question);
