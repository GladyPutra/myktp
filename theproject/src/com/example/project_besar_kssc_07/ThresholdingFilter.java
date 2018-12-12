package com.example.project_besar_kssc_07;

import android.graphics.Bitmap;
import android.graphics.Color;

public class ThresholdingFilter {
	
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ METHODS ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
	
	/**
	 * Methods that apply a Thresholding Effect on image
	 *
	 * @param imageIn the input image
	 * @param threshold Integer - value (0-255) prefered value
	(threshold = 125)
	 * @return
	 */
	
	public static AndroidImage processThresholding(AndroidImage imageIn, int threshold) {
		// The Resulting image
		AndroidImage imageOut;
		// Initiate the Output image
		imageOut = new AndroidImage(imageIn.getImage());
		// Do Threshold process
		for(int y=0; y<imageIn.getHeight(); y++){
			for(int x=0; x<imageIn.getWidth(); x++){
				if(imageOut.getRComponent(x,y) < threshold){
					imageOut.setPixelColor(x, y, 255,255,255);
				}
				else{
					imageOut.setPixelColor(x, y, 0,0,0);
				}
			}
		}
		// Return final image
		return imageOut;
	}
	
	public static int[] convertMatriksLinear(AndroidImage imageIn){
		int x=0;
		int[ ] tempMatriksLinear=new int[(imageIn.getWidth()*imageIn.getHeight())];
		for(int i=0;i<imageIn.getWidth();i++){
			for(int j=0;j<imageIn.getHeight();j++){
				tempMatriksLinear[x]=imageIn.getRComponent(i, j);
				x++;
			}
		}
		return tempMatriksLinear;
	}
	
	public static int[][] convertToMatriksGrayscale(AndroidImage imageIn){
		int x=0;
		int [][]tempImage = new
		int[imageIn.getWidth()][imageIn.getHeight()];
			for(int i=0;i<imageIn.getWidth();i++){
				for(int j=0;j<imageIn.getHeight();j++){
					tempImage[i][j]=Math. round(0.299f * imageIn.getRComponent(i, j) + 0.587f * 
							imageIn.getGComponent(i, j) + 0.114f * imageIn.getBComponent(i, j));
				}
			 }
		return tempImage;
	}
	
	public static int[][] ProccessLuminance(AndroidImage imageIn){
		int x=0;
		int [][]tempImage = new int[imageIn.getWidth()][imageIn.getHeight()];
		for(int i=0;i<imageIn.getWidth();i++){
			for(int j=0;j<imageIn.getHeight();j++){ tempImage[i][j]=Math. round(0.299f *
					imageIn.getRComponent(i, j) + 0.587f * imageIn.getGComponent(i, j) +
					0.114f * imageIn.getBComponent(i, j));
			}
		}
		return tempImage;
	}
	
	public static Bitmap ConvertToImage(int[][] matrix){
		int w = matrix. length; int h = matrix[0]. length;
		Bitmap bmp = Bitmap. createBitmap(w, h, Bitmap.Config. ARGB_8888);;
		for (int i = 0; i < w; i++){
			for (int j = 0; j < h; j++){
				bmp.setPixel(i, j, Color. rgb(matrix[i][j], matrix[i][j], matrix[i][j]));
			}
		}
		return bmp;
	}
	
	/* input bitmap dan nilai ambang, output bitmap b/w */
	public static double[][] ThresholdByValue(AndroidImage bmp, int val){
		double[][] mtxThreshold = new double[bmp.getWidth()][bmp.getHeight()];
		for (int i = 0; i < bmp.getWidth(); i++){
			for (int j = 0; j < bmp.getHeight(); j++){
				if (bmp.getRComponent(i,j) >= val && bmp.getGComponent(i,j)>= val && bmp.getBComponent(i,j) >= val){ 
					mtxThreshold[i][j] = 1; } // di atas atau sama dengan nilai ambang --> 1
				else { 
					mtxThreshold[i][j] = 0; } // di bawah nilai ambang --> 0
				}
			}
		return mtxThreshold;
	}
	
	/* konversi dari matriks ke bitmap ~ 0 jd hitam, 1 jd putih */
	public static Bitmap ConvertToBitmap(double[][] matrix){
		int w = matrix. length; int h = matrix[0]. length; 
		Bitmap bmp = Bitmap. createBitmap(w, h, Bitmap.Config. ARGB_8888);;
		for (int i = 0; i < w; i++){
			for (int j = 0; j < h; j++){
				if (matrix[i][j] == 0)
					bmp.setPixel(i, j, Color. BLACK);
				else
					bmp.setPixel(i, j, Color. WHITE);
			}
		}
		return bmp;
	}
	
	public static double[][] ConvertToMatrix(AndroidImage imageIn){
		//Tambahan
		double[][] matrix = new double[imageIn.getHeight()] [imageIn.getWidth()];
		for (int i = 0; i < imageIn.getHeight(); i++){
			for (int j = 0; j < imageIn.getWidth(); j++){
				if (imageIn.getRComponent(j, i) == 255 && imageIn.getGComponent(j, i) == 255 && 
						imageIn.getBComponent(j, i) == 255){
					matrix[i][j] = 1;
				}
				else{
					matrix[i][j] = 0;
				}
			}
		}
		return matrix;
	}
	
	public static int[][] WaveletHaar2D(AndroidImage bmp, int lvl){
		int[][] matrix = convertToMatriksGrayscale(bmp);
		int[] temp_row = new int[bmp.getHeight()];
		int[] temp_col = new int[bmp.getWidth()];
		int i = 0; int j = 0;
		int w = matrix[1]. length;
		int h = matrix[0]. length;
		
		while (w > lvl || h > lvl){
			if (w > lvl){
				for (i = 0; i < h; i++){
					for (j = 0; j < matrix[1]. length; j++){
						temp_row[j] = matrix[i][j];
					}
					WaveletHaar1D(temp_row, matrix[1]. length, w);
					
					for (j = 0; j < matrix[1]. length; j++){
						matrix[i][j] = temp_row[j];
					}
				}
			}
			
			if (h > lvl){
				for (i = 0; i < w; i++){
					for (j = 0; j < matrix[0]. length; j++){
						temp_col[j] = matrix[j][i];
					}
					WaveletHaar1D(temp_col, matrix[0]. length, h);
					
					for (j = 0; j < matrix[0]. length; j++){
						matrix[j][i] = temp_col[j];
					}
				}
			}
			
			if (w > 1)
				w /= 2;
			
			if (h > 1)
				h /= 2;
		}
		
		return matrix;
	 }
	
	/* transfornasi wavelet vektor (1 dimensi) */
	private static void WaveletHaar1D(int[] vec, int n, int w){
		int[] vec_temp = new int[n];
		for (int i = 0; i < n; i++){
			vec_temp[i] = 0;
		}
		
		w /= 2;
		for (int i = 0; i < w; i++){
			vec_temp[i] = (vec[2 * i] + vec[2 * i + 1]) / 2; //dibagi 2 karena tidak ternormalisasi
			vec_temp[i + w] = (vec[2 * i] - vec[2 * i + 1]) / 2; //dibagi 2 karena tidak ternormalisasi
		}
		
		for (int i = 0; i < (w * 2); i++){
			vec[i] = vec_temp[i];
		}
	}
	
	public static double[] BentukVektorInput(double[][] matriks){
		double[] vek_Input = new double[1025];
		int index = 1;
		vek_Input[0] = 1.0;
		for (int i = 0; i < 32; i++){
			for (int j = 0; j < 32; j++){
				if (matriks[i][j] == 1)
					vek_Input[index] = 0.0;
				else
					vek_Input[index] = 1.0;
				index++;
			}
		}
		return vek_Input;
	 }
	
	/* mengubah matriks hasil wavelet ke bentuk bitmap (untuk
	ditampilkan) */
	public static Bitmap drawWaveletBmp(int[][] matrix, int lv){
		Bitmap newBmp = Bitmap. createBitmap(lv, lv, Bitmap.Config. ARGB_8888);
		for (int i = 0; i < newBmp.getHeight(); i++){
			for (int j = 0; j < newBmp.getWidth(); j++){
				newBmp.setPixel(j, i, Color. rgb((int)matrix[j][i], (int)matrix[j][i], (int)matrix[j][i]));
			}
		}
		return newBmp;
	 }
	
	
	
}
