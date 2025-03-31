export const getRequestUrl = (path: string) => {
  return import.meta.env.APP_URL + ':8000/api/' + path;
};