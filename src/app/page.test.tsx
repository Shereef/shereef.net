import React from 'react';
import { render, screen } from '@testing-library/react';
import Home from './page';
import '@testing-library/jest-dom';

describe('Home', () => {
  it('renders Coming Soon text', () => {
    render(<Home />);
    const comingSoonText = screen.getByText('Coming Soon');
    expect(comingSoonText).toBeInTheDocument();
  });
});
