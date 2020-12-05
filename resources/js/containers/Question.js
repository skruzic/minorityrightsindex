import React from 'react';
import PropTypes from 'prop-types';
import { connect } from 'react-redux';
import { withStyles } from '@material-ui/core';
import { withRouter } from 'react-router-dom';
import { compose } from 'redux';
import { Field, formValueSelector } from 'redux-form';
import Card from '@material-ui/core/Card';
import LinearProgress from '@material-ui/core/LinearProgress';
import CardActions from '@material-ui/core/CardActions';
import TextQuestion from '../components/TextQuestion';
import RadioQuestion from '../components/RadioQuestion';
import CheckboxQuestion from '../components/CheckboxQuestion';
import Button from '@material-ui/core/Button';
import { isEmpty } from 'lodash';
import { saveResponse } from '../slices/campaignsSlice';
import LikertQuestion from '../components/LikertQuestion';

const Question = ({
    question,
    classes,
    nextStep,
    previousStep,
    goToStep,
    currentStep,
    totalSteps,
    conditionalJump,
    value,
    invite,
    saveResponse
}) => {
    const renderQuestion = question => {
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
                        //onBlur={handleSave}
                    />
                );
            case 2:
                return (
                    <Field
                        key={question.id}
                        component={RadioQuestion}
                        name={question.code}
                        text={question.text}
                        options={question.optiongroup.options}
                        //onBlur={handleSave}
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
                        //saveFn={handleSave}
                    />
                );
            case 4:
                return (
                    /*<Field
                        key={question.id}
                        component={LikertQuestion}
                        name={question.code}
                        text={question.text}
                        options={question.optiongroup.options}
                        questions={question.children}
                    />*/
                    <LikertQuestion
                        key={question.id}
                        name={question.code}
                        text={question.text}
                        options={question.optiongroup.options}
                        questions={question.children}
                        invite={invite}
                        currentStep={currentStep}
                    />
                );
            case 5:
                return null;
            default:
                return null;
        }
    };

    const handleSave = () => {
        // Ne piši ništa ako pitanje ima children pitanja (Likert)
        question.type !== 4 &&
            saveResponse({
                invite_id: invite.id,
                question_id: question.id,
                answer: value,
                page: currentStep + 1
            });
    };

    console.log(question);

    return (
        <>
            <LinearProgress
                variant="determinate"
                value={((currentStep - 1) / totalSteps) * 100}
            />
            <Card className={classes.root}>
                {renderQuestion(question)}
                <CardActions className={classes.actions} disableSpacing={true}>
                    {currentStep < totalSteps - 1 && (
                        <Button
                            variant="contained"
                            color="primary"
                            onClick={() => {
                                if (isEmpty(question.conditions)) {
                                    nextStep();
                                } else if (
                                    question.conditions[0].answer === value
                                ) {
                                    goToStep(conditionalJump);
                                } else {
                                    nextStep();
                                }

                                handleSave();
                            }}
                        >
                            Next
                        </Button>
                    )}
                    {currentStep === totalSteps - 1 && (
                        <Button
                            variant="contained"
                            color="primary"
                            onClick={() => {
                                handleSave();
                                nextStep();
                            }}
                        >
                            Finish
                        </Button>
                    )}
                    {currentStep !== 1 && (
                        <Button variant="contained" color="primary">
                            Back
                        </Button>
                    )}
                </CardActions>
            </Card>
        </>
    );
};

Question.propTypes = {
    question: PropTypes.object.isRequired
};

const styles = theme => ({
    root: {
        display: 'flex',
        flexDirection: 'column',
        padding: theme.spacing(1)
    },
    actions: {
        display: 'flex',
        flexDirection: 'row-reverse',
        justifyContent: 'space-between'
    }
});

const selector = formValueSelector('campaignForm');

const mapStateToProps = (state, ownProps) => {
    return {
        value: selector(state, ownProps.question.code),
        invite: state.invite.data
    };
};

export default compose(
    connect(mapStateToProps, { saveResponse }),
    withStyles(styles, { withTheme: true }),
    withRouter
)(Question);
