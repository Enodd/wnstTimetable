import { CSSObject } from '@mui/material';

export const hoverBarAnimation = (color: string): CSSObject => {
  return {
    position: 'relative',
    '&:before': {
      content: '""',
      position: 'absolute',
      width: '100%',
      height: '2px',
      bottom: 0,
      left: 0,
      background: color,
      transform: 'scaleX(0)',
      willChange: 'transform',
      transition: '0.1s ease-in'
    },
    '&:hover:before': { transform: 'scaleX(1)' }
  };
};